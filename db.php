<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "eventflow";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}