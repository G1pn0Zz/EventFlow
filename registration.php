
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Регистрация — EventFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: #f8f3f8;
            color: #333;
        }
        header {
            background: linear-gradient(90deg, #ffd6f0, #d6eaff);
        }
        .form-container {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
            max-width: 550px;
            margin: 60px auto;
        }
        .btn-main {
            background: #ffb3d9;
            border: none;
            transition: 0.3s;
        }
        .btn-main:hover {
            opacity: 0.8;
        }
        footer {
            background: #f0eafa;
            padding: 30px 0;
            text-align: center;
            margin-top: 60px;
        }
    </style>
</head>
<body>
    <?php
session_start();
if (isset($_SESSION["error"])) {
    echo '<div class="alert alert-danger text-center">'.$_SESSION["error"].'</div>';
    unset($_SESSION["error"]);
}
?>
<header class="py-3 shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <h2 class="m-0">EventFlow</h2>
        <a href="index.php" class="btn btn-primary" style="background:#ffb3d9;border:none;">На главную</a>
    </div>
</header>
<div class="container">
    <div class="form-container">
        <h3 class="text-center mb-4">Регистрация</h3>
        <form method="POST" action="register_handler.php" novalidate>

            <label class="form-label">ФИО</label>
            <input type="text" name="fullname" class="form-control mb-3" placeholder="Иванов Иван Иванович" pattern="[А-Яа-яЁё\s]+" required>

            <label class="form-label">Электронная почта</label>
            <input type="email" name="email" class="form-control mb-3" placeholder="example@mail.ru" required>

            <label class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control mb-3" minlength="8" pattern="[A-Za-z0-9!@#$%^&*()_+=-]+" required>

            <label class="form-label">Подтверждение пароля</label>
            <input type="password" name="password_confirm" class="form-control mb-4" minlength="8" required>

            <button type="submit" class="btn btn-main w-100 py-2">Зарегистрироваться</button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
