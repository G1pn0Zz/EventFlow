<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход администратора</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center" style="height:100vh;background:#f8f3f8;">

<form method="POST" action="admin_login_handler.php"
      class="p-4 bg-white rounded shadow" style="width:350px;">
    <h4 class="mb-4 text-center">Администратор</h4>

    <input type="email" name="email" class="form-control mb-3"
           placeholder="Email администратора" required>

    <input type="password" name="password" class="form-control mb-3"
           placeholder="Пароль" required>

    <button class="btn btn-danger w-100">Войти</button>
</form>

</body>
</html>
