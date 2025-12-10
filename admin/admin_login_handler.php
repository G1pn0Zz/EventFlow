<?php
session_start();
require_once __DIR__ . "/../db.php";

$email    = $_POST["email"];
$password = $_POST["password"];

$sql = "
    SELECT * FROM users
    WHERE email='$email'
      AND password='$password'
      AND role='admin'
";

$result = $conn->query($sql);

if ($result && $result->num_rows === 1) {

    $admin = $result->fetch_assoc();

    $_SESSION["admin_id"] = $admin["id"];
    $_SESSION["admin_name"] = $admin["fullname"];

    header("Location: users.php");
    exit;

} else {
    die("Неверные данные администратора");
}