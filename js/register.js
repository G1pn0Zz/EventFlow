document.getElementById("registerForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const fullName = document.getElementById("fullName").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    let isValid = true;

    // Очистка ошибок
    document.querySelectorAll(".error").forEach(el => el.textContent = "");

    // ФИО — только русские буквы и пробелы
    const nameRegex = /^[А-Яа-яЁё\s]+$/;
    if (!nameRegex.test(fullName)) {
        document.getElementById("nameError").textContent =
            "ФИО должно содержать только русские буквы";
        isValid = false;
    }

    // Email — валидный формат
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        document.getElementById("emailError").textContent =
            "Введите корректный email";
        isValid = false;
    }

    // Пароль — латиница, цифры, символы, минимум 8
    const passwordRegex = /^[A-Za-z0-9!@#$%^&*()_+=\-{}[\]:;"'<>,.?/\\|]{8,}$/;
    if (!passwordRegex.test(password)) {
        document.getElementById("passwordError").textContent =
            "Минимум 8 символов: латиница, цифры и спецсимволы";
        isValid = false;
    }

    // Подтверждение пароля
    if (password !== confirmPassword) {
        document.getElementById("confirmError").textContent =
            "Пароли не совпадают";
        isValid = false;
    }

    if (isValid) {
        alert("Регистрация прошла успешно (логика отправки будет добавлена позже)");
        document.getElementById("registerForm").reset();
    }
});

// ПОТОМ УБРАТЬ
const users = JSON.parse(localStorage.getItem("users")) || [];

users.push({
    fullName,
    email,
    password,
    role: "user"
});

localStorage.setItem("users", JSON.stringify(users));