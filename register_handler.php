
<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $fullname = $_POST["fullname"];
    $email    = $_POST["email"];
    $password = $_POST["password"];
    $confirm  = $_POST["password_confirm"];

    // Проверка паролей
    if ($password !== $confirm) {
        die("Пароли не совпадают");
    }

    // Проверка существования email
    $check = $conn->query("SELECT id FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        die("Пользователь с таким email уже существует");
    }

    // Сохранение пользователя (БЕЗ хеширования, как ты просил ранее)
    $sql = "INSERT INTO users (fullname, email, password)
            VALUES ('$fullname', '$email', '$password')";

    if ($conn->query($sql)) {
        header("Location: login.html");
        exit;
    } else {
        echo "Ошибка при регистрации";
    }
}