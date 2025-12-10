<?php
session_start();

// Защитная проверка: если пользователь не залогинен — редирект на страницу входа
if (!isset($_SESSION['user_id'])) {
    header('Location: /login.php');
    exit;
}

// Если роль не admin — не показываем кнопку (можно показать сообщение)
$is_admin = (isset($_SESSION['role']) && $_SESSION['role'] === 'admin');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <style>
body {
    background: #f8f3f8;
    font-family: system-ui, sans-serif;
}

/* Заголовок */
.page-title {
    margin: 30px 0 20px;
    font-weight: 600;
}

/* Карточка */
.card-box {
    background: #fff;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 6px 18px rgba(0,0,0,.08);
}

/* Фильтры */
.filter-form input,
.filter-form select {
    border-radius: 10px;
}

/* Таблица */
.table {
    margin-top: 20px;
}

.table thead {
    background: linear-gradient(90deg,#ffd6f0,#d6eaff);
}

.table thead th {
    border: none;
    text-align: center;
    font-weight: 600;
}

.table tbody td {
    vertical-align: middle;
    text-align: center;
}

/* Статусы */
.status-active {
    color: #198754;
    font-weight: 600;
}

.status-deleted {
    color: #dc3545;
    font-weight: 600;
}

/* Кнопки действий */
.action-btn {
    text-decoration: none;
    font-size: 18px;
    margin: 0 5px;
}

.action-edit { color: #0d6efd; }
.action-pass { color: #fd7e14; }
.action-del  { color: #dc3545; }

.action-btn:hover {
    opacity: .7;
}

/* Верхняя панель */
.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
</style>
</head>
<body>
    <form method="GET" class="row g-3 mb-4">

    <div class="col-md-3">
        <input type="text" name="fullname" class="form-control" placeholder="ФИО">
    </div>

    <div class="col-md-2">
        <select name="role" class="form-control">
            <option value="">Все роли</option>
            <option value="user">Пользователь</option>
            <option value="admin">Администратор</option>
        </select>
    </div>

    <div class="col-md-2">
        <select name="status" class="form-control">
            <option value="">Все статусы</option>
            <option value="active">Активен</option>
            <option value="deleted">Удалён</option>
        </select>
    </div>

    <div class="col-md-2">
        <input type="date" name="date_from" class="form-control">
    </div>

    <div class="col-md-2">
        <input type="date" name="date_to" class="form-control">
    </div>

    <div class="col-md-1">
        <button class="btn btn-primary w-100">Найти</button>
    </div>

</form>

<?php
$where = [];

if (!empty($_GET['fullname'])) {
    $fullname = $conn->real_escape_string($_GET['fullname']);
    $where[] = "fullname LIKE '%$fullname%'";
}

if (!empty($_GET['role'])) {
    $role = $conn->real_escape_string($_GET['role']);
    $where[] = "role='$role'";
}

if (!empty($_GET['status'])) {
    $status = $conn->real_escape_string($_GET['status']);
    $where[] = "status='$status'";
}

if (!empty($_GET['date_from']) && !empty($_GET['date_to'])) {
    $where[] = "created_at BETWEEN '{$_GET['date_from']}' AND '{$_GET['date_to']}'";
}

$sql = "SELECT * FROM users";

if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$result = $conn->query($sql);
?>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>ФИО</th>
        <th>Email</th>
        <th>Роль</th>
        <th>Дата</th>
        <th>Статус</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($u = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $u['fullname'] ?></td>
            <td><?= $u['email'] ?></td>
            <td><?= $u['role'] ?></td>
            <td><?= $u['created_at'] ?></td>
            <td><?= $u['status'] ?></td>
            <td>
                ✏️ 🔑 ❌
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<?php
session_start();
require_once __DIR__ . "/../db.php";

if (!isset($_SESSION["admin_id"])) {
    die("Доступ только для администратора");
}
?>
</body>
</html>