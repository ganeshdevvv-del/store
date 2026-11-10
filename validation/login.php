
<?php

require __DIR__ . '/../connection/db.php';

$errors = [];
$email = '';
$role = 'student';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'student';
    }
    else {

        $table = $role === 'admin' ? 'admin' : 'students';

        $sql = "SELECT id, password FROM $table WHERE email = ?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password'])) {

            if ($role === 'admin') {
                header('Location: ../dashboard/admin.php');
            } else {
                header('Location: ../dashboard/student.php');
            }

            exit;

        } else {
            $errors[] = "Invalid email or password.";
        }

        mysqli_stmt_close($stmt);
    }


mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="login-page">

    <h2>Welcome Back</h2>

    <?php foreach ($errors as $error): ?>
        <p style="color:red;">
            <?= htmlspecialchars($error) ?>
        </p>
    <?php endforeach; ?>

    <form method="POST" action="">

        <div class="form-field">
            <label>Login As:</label>
            <select name="role" required>
                <option value="student" <?= $role === 'student' ? 'selected' : '' ?>>Student</option>
                <option value="admin" <?= $role === 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>

        <div class="form-field">
            <label>Email:</label>
            <input type="email" name="email"
                value="<?= htmlspecialchars($email) ?>" required>
        </div>

        <div class="form-field">
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>

        <div class="form-actions">
            <button type="submit">Login</button>
        </div>

    </form>

</body>
</html>
