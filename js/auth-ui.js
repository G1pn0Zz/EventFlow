document.addEventListener("DOMContentLoaded", () => {
    const authBlock = document.getElementById("authBlock");
    const currentUser = JSON.parse(localStorage.getItem("currentUser"));

    if (!authBlock) return;

    if (currentUser) {
        authBlock.innerHTML = `
            <span class="user-name">${currentUser.fullName}</span>
            <button class="logout-btn" onclick="logout()">Выйти</button>
        `;
    }
});

function logout() {
    localStorage.removeItem("currentUser");
    window.location.reload();
}