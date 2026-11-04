<?php
session_start();

$conn = require __DIR__ . "/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name    = trim($_POST['name']    ?? '');
    $email   = trim($_POST['email']   ?? '');
    $phone   = trim($_POST['phone']   ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $subject === '' || $message === '') {
        $_SESSION["flash"]      = "Please fill in all required fields.";
        $_SESSION["flash_type"] = "error";
        header("Location: index.php", true, 303);
        exit;
    }

    $sql  = "INSERT INTO register (name, email, phone, subject, message)
             VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $phone, $subject, $message);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION["flash"]      = "Message sent successfully!";
        $_SESSION["flash_type"] = "success";
    } else {
        $_SESSION["flash"]      = "Error saving message. Please try again.";
        $_SESSION["flash_type"] = "error";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header("Location: index.php", true, 303);
    exit;
}

// If someone visits this file directly via GET, just redirect
header("Location: index.php");
exit;
