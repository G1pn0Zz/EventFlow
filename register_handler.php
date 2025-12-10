<?php
session_start();
require_once "db.php";

$fullname = trim($_POST["fullname"]);
$email    = trim($_POST["email"]);
$password = trim($_POST["password"]);

// ---- ВАЛИДАЦИЯ ----
if ($fullname === "" || $email === "" || $password === "") {
    $_SESSION["error"] = "Все поля обязательны для заполнения";
    header("Location: registration.html");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION["error"] = "Неверный формат электронной почты";
    header("Location: registration.html");
    exit;
}

if (strlen($password) < 8) {
    $_SESSION["error"] = "Пароль должен быть не менее 8 символов";
    header("Location: registration.html");
    exit;
}

// ---- ПРОВЕРКА EMAIL ----
$check = $conn->query("SELECT id FROM users WHERE email='$email'");
if ($check->num_rows > 0) {
    $_SESSION["error"] = "Пользователь с такой почтой уже существует";
    header("Location: registration.html");
    exit;
}

// ---- СОХРАНЕНИЕ ----
$conn->query("
    INSERT INTO users (fullname, email, password, role, status)
    VALUES ('$fullname', '$email', '$password', 'user', 'active')
");

$_SESSION["success"] = "Регистрация прошла успешно. Войдите в аккаунт.";
header("Location: login.html");
exit;