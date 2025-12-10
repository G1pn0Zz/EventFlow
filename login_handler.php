<?php
session_start();
require_once "db.php";

$email    = $_POST["email"];
$password = $_POST["password"];

$res = $conn->query("
    SELECT * FROM users
    WHERE email='$email'
      AND password='$password'
      AND status='active'
");

if ($res->num_rows === 1) {

    $user = $res->fetch_assoc();
    $_SESSION["user_id"]  = $user["id"];
    $_SESSION["fullname"] = $user["fullname"];

    //  успешная авторизация
    header("Location: index.php");
    exit;

} else {
    //  неверные данные
    $_SESSION["error"] = "Неверная почта или пароль";
    header("Location: login.html");
    exit;
}