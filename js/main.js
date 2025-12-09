const events = [
    {
        title: "Концерт Imagine Dragons",
        img: "https://picsum.photos/400/200?1",
        date: "10.06.2025 – 10.06.2025",
        people: 4500,
        status: "Активное",
        info: "Большой концерт на стадионе"
    },
    {
        title: "Театральная премьера",
        img: "https://picsum.photos/400/200?2",
        date: "01.05.2025 – 01.05.2025",
        people: 320,
        status: "Прошедшее",
        info: "Драматический спектакль"
    }
];

// добиваем до 6 карточек
while (events.length < 7) {
    events.push(events[0]);
}

const container = document.getElementById("events-container");

function renderEvents(filter) {
    container.innerHTML = "";
    events.forEach(event => {
        if (
            (filter === "active" && event.status !== "Прошедшее") ||
            (filter === "past" && event.status === "Прошедшее")
        ) {
            container.innerHTML += `
            <div class="card">
                <img src="${event.img}">
                <div class="card-content">
                    <h3>${event.title}</h3>
                    <p>${event.date}</p>
                    <p>Участников: ${event.people}</p>
                    <p class="status">${event.status}</p>
                </div>
                <div class="tooltip">
                    <h4>Описание</h4>
                    <p>${event.info}</p>
                </div>
            </div>`;
        }
    });
}

renderEvents("active");

document.querySelectorAll(".tab").forEach(tab => {
    tab.addEventListener("click", () => {
        document.querySelectorAll(".tab").forEach(t => t.classList.remove("active"));
        tab.classList.add("active");
        renderEvents(tab.dataset.tab);
    });
});