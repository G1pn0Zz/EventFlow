document.getElementById("resetPasswordForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const newPassword = document.getElementById("newPassword").value;
    const confirmPassword = document.getElementById("confirmNewPassword").value;

    let valid = true;

    document.getElementById("newPasswordError").textContent = "";
    document.getElementById("confirmNewPasswordError").textContent = "";

    // Пароль: минимум 8 символов, латиница, цифры, спецсимволы
    const passwordRegex = /^[A-Za-z0-9!@#$%^&*()_+=\-{}[\]:;"'<>,.?/\\|]{8,}$/;
    if (!passwordRegex.test(newPassword)) {
        document.getElementById("newPasswordError").textContent =
            "Минимум 8 символов (латиница, цифры, спецсимволы)";
        valid = false;
    }

    if (newPassword !== confirmPassword) {
        document.getElementById("confirmNewPasswordError").textContent =
            "Пароли не совпадают";
        valid = false;
    }

    if (!valid) return;

    // ⏭ Будущее: проверка токена и сохранение нового пароля
    alert("Пароль успешно изменён. Войдите с новым паролем.");

    window.location.href = "login.html";
});