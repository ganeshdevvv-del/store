<?php

$recordsPerPage = 10;

$searchTerm = is_string($_GET["search"] ?? null) ? trim($_GET["search"]) : "";
$whereSql = "";

if ($searchTerm !== "") {
    $whereSql = " WHERE name LIKE ? OR email LIKE ? OR phone LIKE ? OR subject LIKE ? OR message LIKE ?";
    $likeTerm = "%" . $searchTerm . "%";

    $countStmt = mysqli_prepare($conn, "SELECT COUNT(*) AS total FROM register" . $whereSql);
    mysqli_stmt_bind_param($countStmt, "sssss", $likeTerm, $likeTerm, $likeTerm, $likeTerm, $likeTerm);
} else {
    $countStmt = mysqli_prepare($conn, "SELECT COUNT(*) AS total FROM register");
}

mysqli_stmt_execute($countStmt);
$countResult = mysqli_stmt_get_result($countStmt);
$totalRows = (int) mysqli_fetch_assoc($countResult)["total"];
mysqli_free_result($countResult);
mysqli_stmt_close($countStmt);

$totalPages = max(1, (int) ceil($totalRows / $recordsPerPage));
$requestedPage = filter_var($_GET["page"] ?? 1, FILTER_VALIDATE_INT, [
    "options" => ["min_range" => 1],
]);
$currentPage = ($requestedPage === false) ? 1 : min($requestedPage, $totalPages);
$offset = ($currentPage - 1) * $recordsPerPage;

$dataSql = "SELECT id, name, email, phone, subject, message
            FROM register" . $whereSql . "
            ORDER BY id ASC
            LIMIT ? OFFSET ?";
$dataStmt = mysqli_prepare($conn, $dataSql);

if ($searchTerm !== "") {
    mysqli_stmt_bind_param(
        $dataStmt,
        "sssssii",
        $likeTerm,
        $likeTerm,
        $likeTerm,
        $likeTerm,
        $likeTerm,
        $recordsPerPage,
        $offset
    );
} else {
    mysqli_stmt_bind_param($dataStmt, "ii", $recordsPerPage, $offset);
}

mysqli_stmt_execute($dataStmt);
$dataResult = mysqli_stmt_get_result($dataStmt);

$rows = [];
while ($row = mysqli_fetch_assoc($dataResult)) {
    $rows[] = $row;
}


mysqli_free_result($dataResult);
mysqli_stmt_close($dataStmt);
