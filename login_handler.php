<?php
session_start();
require_once __DIR__ . "/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email    = $_POST["email"];
    $password = $_POST["password"];

    // Ищем пользователя
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {

        $user = $result->fetch_assoc();

        // Запоминаем пользователя
        $_SESSION["user_id"]  = $user["id"];
        $_SESSION["fullname"] = $user["fullname"];

        // Вход успешен
        header("Location: index.php");
        exit;

    } else {
        echo "Неверная почта или пароль";
    }
}