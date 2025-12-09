const events = [
    {
        id: 1,
        title: "Лекция по веб-разработке",
        image: "https://picsum.photos/400/200",
        startDate: "2025-06-01",
        endDate: "2025-06-10",
        participants: 45,
        limit: 50,
        isParticipant: true,
        description: "Подробное описание лекции"
    },
    {
        id: 2,
        title: "Старый концерт",
        image: "https://picsum.photos/400/201",
        startDate: "2025-03-01",
        endDate: "2025-03-05",
        participants: 300,
        limit: null,
        isParticipant: false,
        description: "Концерт прошёл"
    }
];

const container = document.getElementById("eventsContainer");
const tabs = document.querySelectorAll(".tab");

function getStatus(event) {
    const now = new Date();
    if (now > new Date(event.endDate)) return "Прошедшее";
    if (now >= new Date(event.startDate)) return "Активное";
    return "Отклоненное";
}

function renderEvents(filter) {
    container.innerHTML = "";

    const filtered = events.filter(e => {
        const status = getStatus(e);
        if (filter === "active") return status === "Активное";
        if (filter === "past") return status === "Прошедшее";
        if (filter === "mine")
            return e.isParticipant && (status === "Активное" || status === "Прошедшее");
    });

    if (filtered.length === 0) {
        const msg = {
            active: "Нет активных событий",
            mine: "Вы не участвуете ни в одном событии",
            past: "Нет прошедших событий"
        };
        container.innerHTML = `<p class="empty-message">${msg[filter]}</p>`;
        return;
    }

    filtered.forEach(e => {
        const status = getStatus(e);

        container.innerHTML += `
        <div class="card" onclick="openEvent(${event.id})">
            <img src="${e.image}">
            <div class="card-content">
                <h3>${e.title}</h3>
                <p>${e.startDate} — ${e.endDate}</p>
                <p>Участников: ${e.participants}</p>
                <p class="status">${status}</p>
            </div>
            <div class="tooltip">
                ${e.description}
            </div>
        </div>`;
    });
}

function openEvent(id) {
    window.location.href = `./event.html?id=${id}`;
}

renderEvents("mine");

tabs.forEach(tab => {
    tab.addEventListener("click", () => {
        tabs.forEach(t => t.classList.remove("active"));
        tab.classList.add("active");
        renderEvents(tab.dataset.filter);
    });
});

function openEvent(eventId) {
    localStorage.setItem("selectedEventId", eventId);
    window.location.href = "./event.html";
}
