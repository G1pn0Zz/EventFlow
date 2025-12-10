<?php
session_start();
require_once __DIR__ . "/db.php";

$role = null;

if (isset($_SESSION["user_id"])) {
    $id = $_SESSION["user_id"];
    $res = $conn->query("SELECT role FROM users WHERE id=$id");
    if ($res && $res->num_rows === 1) {
        $user = $res->fetch_assoc();
        $role = $user["role"];
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EventFlow – Электронная афиша</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: #f8f3f8;
            color: #333;
        }
        header {
            background: linear-gradient(90deg, #ffd6f0, #d6eaff);
        }
        .nav-link:hover, .btn:hover {
            opacity: 0.8;
            transition: 0.3s;
        }
        .slider-placeholder {
            height: 350px;
            background: #e8dff5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: #666;
        }
        .banner {
            height: 200px;
            background: linear-gradient(90deg, #ffe3ec, #e3f1ff);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }
        .event-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: 0.3s;
            position: relative;
        }
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 14px rgba(0,0,0,0.1);
        }
        .tooltip-box {
            display: none;
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(0,0,0,0.75);
            color: #fff;
            padding: 10px;
            border-radius: 8px;
            z-index: 10;
            font-size: 0.9rem;
        }
        .event-card:hover .tooltip-box {
            display: block;
        }
        footer {
            background: #f0eafa;
            padding: 30px 0;
            text-align: center;
        }
    </style>
</head>
<body>
<?php session_start(); ?>
<header class="py-3 shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        <h2 class="m-0">EventFlow</h2>

        <div>

<?php if (!isset($_SESSION["user_id"])): ?>

    <a href="login.php" class="btn me-2"
       style="background:#ffb3d9;border:none;">
        Вход
    </a>

    <a href="registration.php" class="btn"
       style="background:#d6eaff;border:none;">
        Регистрация
    </a>

<?php else: ?>

    <span class="me-3">
        <?= $_SESSION["fullname"] ?>
    </span>

    <?php if ($role === 'admin'): ?>
        <a href="admin/users.php"
           class="btn me-2"
           style="background:#dc3545;border:none;">
            Админ-панель
        </a>
    <?php endif; ?>

    <a href="logout.php" class="btn btn-secondary">
        Выйти
    </a>

<?php endif; ?>

    </div>


    </div>
</header>
<section class="mt-4 container">
    <img src="./img/banner.webp"
         alt="Баннер"
         class="img-fluid rounded"
         style="width:100%; height:350px; object-fit:cover;">
</section>

<section class="container mt-5 text-center">
    <h3>О сервисе EventFlow</h3>
    <p class="mt-3">EventFlow — это универсальная электронная афиша, позволяющая легко находить интересующие вас события, следить за их статусом и участвовать в мероприятиях вашего города.</p>
</section>
<section class="container mt-5">
    <ul class="nav nav-tabs" id="eventTabs">

    <li class="nav-item">
        <button class="nav-link active"
                data-bs-toggle="tab"
                data-bs-target="#actual">
            Актуальные события
        </button>
    </li>

    <li class="nav-item">
        <button class="nav-link"
                data-bs-toggle="tab"
                data-bs-target="#past">
            Прошедшие события
        </button>
    </li>

    <?php if (isset($_SESSION["user_id"])): ?>
        <li class="nav-item">
            <button class="nav-link"
                    data-bs-toggle="tab"
                    data-bs-target="#my-events">
                Мои события
            </button>
        </li>
    <?php endif; ?>

</ul>
    <div class="tab-content mt-4">
        <?php if (isset($_SESSION["user_id"])): ?>
<div class="tab-pane fade" id="my-events">
    <div class="alert alert-info">
        Список ваших событий.
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="event-card p-3">
                <h5>Пример моего события</h5>
                <p>Статус: <span class="badge bg-success">Вы участвуете</span></p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
        <div class="tab-pane fade show active" id="actual">
            <div class="row g-4">
                <?php for($i=1;$i<=6;$i++): ?>
                <div class="col-md-4">
                    <div class="event-card p-3">
                        <div class="tooltip-box">Дополнительная информация о событии <?= $i ?></div>
                        <img src="img/<?= $i ?>.jpg" alt="Событие <?= $i ?>" class="img-fluid mb-2" style="height:150px; width:100%; object-fit:cover; border-radius:10px;">
                        <h5>Название события <?= $i ?></h5>
                        <p>Дата: <strong>01.01.2025 - 05.01.2025</strong></p>
                        <p>Участники: <strong><?= rand(10,200) ?></strong></p>
                        <p>Статус: <span class="badge bg-success">Активное</span></p>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </div>
        <div class="tab-pane fade" id="past">
            <div class="row g-4">
                <?php for($i=1;$i<=6;$i++): ?>
                <div class="col-md-4">
                    <div class="event-card p-3">
                        <div class="tooltip-box">Дополнительная информация о событии <?= $i ?></div>
                        <img src="img/<?= $i ?>.jpg" alt="Событие <?= $i ?>" class="img-fluid mb-2" style="height:150px; width:100%; object-fit:cover; border-radius:10px;">
                        <h5>Название события <?= $i ?></h5>
                        <p>Дата: <strong>10.01.2025 - 12.01.2025</strong></p>
                        <p>Участники: <strong><?= rand(10,200) ?></strong></p>
                        <p>Статус: <span class="badge bg-secondary">Прошедшее</span></p>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</section>

<?php if (isset($_SESSION["user_id"])): ?>
<section class="container mt-5">
    <h3 class="text-center mb-4">Отзывы пользователей</h3>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="p-4 bg-white rounded shadow-sm h-100">
                <p>
                    ⭐⭐⭐⭐⭐  
                    <br>
                    Очень удобный сервис! Нашёл несколько интересных событий и записался без проблем.
                </p>
                <strong>Иван П.</strong><br>
                <small class="text-muted">Пользователь EventFlow</small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-4 bg-white rounded shadow-sm h-100">
                <p>
                    ⭐⭐⭐⭐☆  
                    <br>
                    Понравился дизайн и простота. Хотелось бы больше мероприятий.
                </p>
                <strong>Анна К.</strong><br>
                <small class="text-muted">Участник мероприятий</small>
            </div>
        </div>

        <div class="col-md-4">
            <div class="p-4 bg-white rounded shadow-sm h-100">
                <p>
                    ⭐⭐⭐⭐⭐  
                    <br>
                    Отличная идея! Удобно следить за событиями своего города.
                </p>
                <strong>Дмитрий С.</strong><br>
                <small class="text-muted">Пользователь</small>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<footer class="mt-5">
    <p>Контакты: info@eventflow.com | +7 (900) 000-00-00</p>
    <p>© 2025 EventFlow — Электронная афиша</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
