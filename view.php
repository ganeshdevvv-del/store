<?php
$conn = require __DIR__ . "/db.php";
$notice = "";
$noticeType = "success";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? "";
    $id = filter_var($_POST["id"] ?? null, FILTER_VALIDATE_INT, [
        "options" => ["min_range" => 1],
    ]);

    if ($id === false) {
        $notice = "The selected registration is invalid.";
        $noticeType = "error";
    } elseif ($action === "delete") {
        $stmt = mysqli_prepare($conn, "DELETE FROM register WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $deleted = mysqli_stmt_affected_rows($stmt) > 0;
        $notice = $deleted
            ? "Registration removed."
            : "Registration not found.";
        $noticeType = $deleted ? "success" : "error";
        mysqli_stmt_close($stmt);
    } elseif ($action === "update") {
        $name = trim($_POST["name"] ?? "");
        $email = trim($_POST["email"] ?? "");
        $phone = trim($_POST["phone"] ?? "");
        $subject = trim($_POST["subject"] ?? "");
        $message = trim($_POST["message"] ?? "");

        if ($name === "" || $email === "" || $subject === "" || $message === "") {
            $notice = "Please fill in all required fields.";
            $noticeType = "error";
        } else {
            $stmt = mysqli_prepare(
                $conn,
                "UPDATE register SET name=?, email=?, phone=?, subject=?, message=? WHERE id=?"
            );
            mysqli_stmt_bind_param($stmt, "sssssi", $name, $email, $phone, $subject, $message, $id);
            mysqli_stmt_execute($stmt);
            $notice = "Registration updated.";
            mysqli_stmt_close($stmt);
        }
    }
}

function escapeHtml(?string $value): string
{
    return htmlspecialchars($value ?? "", ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

require __DIR__ . "/searchPagging.php";

$qsBase = $searchTerm !== "" ? "search=" . urlencode($searchTerm) : "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrations</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <div class="top-bar">
            <h1>Registrations</h1>
            <a href="index.php" class="btn-add">+ Add New</a>
        </div>

        <?php if ($notice !== ""): ?>
            <div class="notice notice-<?= escapeHtml($noticeType) ?>" role="status">
                <?= escapeHtml($notice) ?>
            </div>
        <?php endif; ?>

        <form class="search-bar" method="GET" action="view.php">
            <input type="text" name="search" placeholder="Search registrations..."
                   value="<?= escapeHtml($searchTerm) ?>">
            <button type="submit">Search</button>
            <?php if ($searchTerm !== ""): ?>
                <a href="view.php" class="btn-clear">Clear</a>
            <?php endif; ?>
        </form>

        <?php if ($searchTerm !== ""): ?>
            <p class="search-info">
                Showing <strong><?= count($rows) ?></strong> of
                <strong><?= $totalRows ?></strong> result<?= $totalRows !== 1 ? "s" : "" ?>
                for "<strong><?= escapeHtml($searchTerm) ?></strong>"
            </p>
        <?php endif; ?>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Message</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($rows)): ?>
                        <tr><td class="empty" colspan="7">No registrations found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($rows as $row): ?>
                            <tr class="data-row">
                                <td><?= escapeHtml((string) $row["id"]) ?></td>
                                <td><?= escapeHtml($row["name"]) ?></td>
                                <td><?= escapeHtml($row["email"]) ?></td>
                                <td><?= escapeHtml($row["phone"]) ?></td>
                                <td><?= escapeHtml($row["subject"]) ?></td>
                                <td class="message"><?= escapeHtml($row["message"]) ?></td>
                                <td>
                                    <div class="action-btns">
                                        <button type="button" class="edit-button"
                                            data-id="<?= escapeHtml((string) $row["id"]) ?>"
                                            data-name="<?= escapeHtml($row["name"]) ?>"
                                            data-email="<?= escapeHtml($row["email"]) ?>"
                                            data-phone="<?= escapeHtml($row["phone"]) ?>"
                                            data-subject="<?= escapeHtml($row["subject"]) ?>"
                                            data-message="<?= escapeHtml($row["message"]) ?>"
                                        >Edit</button>

                                        <form method="POST" action="view.php"
                                              onsubmit="return confirm('Remove this registration?');"
                                              style="display:inline;">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?= escapeHtml((string) $row["id"]) ?>">
                                            <button class="remove-button" type="submit">Remove</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if ($totalPages > 1): ?>
            <div class="pagination-wrap">
                <span class="pagination-info">
                    Page <?= $currentPage ?> of <?= $totalPages ?>
                    (<?= $totalRows ?> total record<?= $totalRows !== 1 ? "s" : "" ?>)
                </span>
                <ul class="pagination">
                    <?php
                    if ($currentPage > 1):
                        $prevQs = "page=" . ($currentPage - 1) . ($qsBase !== "" ? "&" . $qsBase : "");
                    ?>
                        <li><a href="view.php?<?= $prevQs ?>">‹</a></li>
                    <?php else: ?>
                        <li class="disabled"><span>‹</span></li>
                    <?php endif; ?>

                    <?php
                    for ($p = 1; $p <= $totalPages; $p++):
                        $pageQs = "page=" . $p . ($qsBase !== "" ? "&" . $qsBase : "");
                        if ($p === $currentPage):
                    ?>
                            <li class="active"><span><?= $p ?></span></li>
                    <?php else: ?>
                            <li><a href="view.php?<?= $pageQs ?>"><?= $p ?></a></li>
                    <?php
                        endif;
                    endfor;
                    ?>

                    <?php
                    if ($currentPage < $totalPages):
                        $nextQs = "page=" . ($currentPage + 1) . ($qsBase !== "" ? "&" . $qsBase : "");
                    ?>
                        <li><a href="view.php?<?= $nextQs ?>">›</a></li>
                    <?php else: ?>
                        <li class="disabled"><span>›</span></li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>
    </main>

    <div class="modal-overlay" id="editModal">
        <div class="modal-box">
            <div class="modal-header">
                <h2>Edit User Details</h2>
                <button type="button" class="modal-close" id="modalClose">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="view.php" id="editForm">
                    <input type="hidden" name="action"     value="update">
                    <input type="hidden" name="id"         id="modal-id">
                    <div class="modal-grid">
                        <div class="modal-field">
                            <label for="modal-name">Name <span style="color:#ef4444">*</span></label>
                            <input type="text" id="modal-name" name="name" required>
                        </div>
                        <div class="modal-field">
                            <label for="modal-email">Email <span style="color:#ef4444">*</span></label>
                            <input type="email" id="modal-email" name="email" required>
                        </div>
                        <div class="modal-field">
                            <label for="modal-phone">Phone</label>
                            <input type="tel" id="modal-phone" name="phone">
                        </div>
                        <div class="modal-field">
                            <label for="modal-subject">Subject <span style="color:#ef4444">*</span></label>
                            <select id="modal-subject" name="subject" required>
                                <option value="" disabled>Select a subject</option>
                                <option value="General Inquiry">General Inquiry</option>
                                <option value="Project Discussion">Project Discussion</option>
                                <option value="Support">Support</option>
                                <option value="Feedback">Feedback</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="modal-field full-width">
                            <label for="modal-message">Message <span style="color:#ef4444">*</span></label>
                            <textarea id="modal-message" name="message" required></textarea>
                        </div>
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn-modal-cancel" id="modalCancelBtn">Cancel</button>
                        <button type="submit" class="btn-modal-update">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const modal      = document.getElementById('editModal');
        const closeBtn   = document.getElementById('modalClose');
        const cancelBtn  = document.getElementById('modalCancelBtn');

        function openEditModal(btn) {
            document.getElementById('modal-id').value      = btn.dataset.id;
            document.getElementById('modal-name').value    = btn.dataset.name;
            document.getElementById('modal-email').value   = btn.dataset.email;
            document.getElementById('modal-phone').value   = btn.dataset.phone   || '';
            document.getElementById('modal-message').value = btn.dataset.message || '';

            const subjectSelect = document.getElementById('modal-subject');
            subjectSelect.value = btn.dataset.subject || '';
            if (!subjectSelect.value) subjectSelect.selectedIndex = 0;

            modal.classList.add('active');
            document.getElementById('modal-name').focus();
        }

        function closeModal() {
            modal.classList.remove('active');
        }

        document.querySelectorAll('.edit-button').forEach(function(btn) {
            btn.addEventListener('click', function() { openEditModal(this); });
        });

        closeBtn.addEventListener('click', closeModal);
        cancelBtn.addEventListener('click', closeModal);

        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('active')) closeModal();
        });
    </script>
</body>
</html>
<?php
mysqli_close($conn);
?>
