document.getElementById("loginForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const email = document.getElementById("loginEmail").value.trim();
    const password = document.getElementById("loginPassword").value;

    let valid = true;

    document.getElementById("loginEmailError").textContent = "";
    document.getElementById("loginPasswordError").textContent = "";

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        document.getElementById("loginEmailError").textContent =
            "Некорректный формат email";
        valid = false;
    }

    if (password.length < 8) {
        document.getElementById("loginPasswordError").textContent =
            "Пароль некорректный";
        valid = false;
    }

    if (!valid) return;

    // ⛔ ВРЕМЕННО: эмуляция существующего пользователя
    if (email === "test@mail.ru" && password === "Test123!") {
        alert("Успешная авторизация");
        window.location.href = "index.html";
    } else {
        alert("Неверная почта или пароль");
    }
});