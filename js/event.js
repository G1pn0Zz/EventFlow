const params = new URLSearchParams(window.location.search);
const eventId = Number(params.get("id"));

const event = events.find(e => e.id === eventId);
const status = getStatus(event);

const card = document.getElementById("eventCard");

function render() {
    card.innerHTML = `
        <h2>${event.title}</h2>
        <img src="${event.image}">
        <p>${event.startDate} — ${event.endDate}</p>
        <p>${event.description}</p>
        <p>${event.price || "Бесплатно"}</p>
        <p>Участников: ${event.participants}</p>
        <p>Статус: ${status}</p>
        <p>${event.isParticipant ? "Вы участвуете" : "Вы не участвуете"}</p>

        ${status === "Активное" && !event.isParticipant ? 
            `<button onclick="join()">Подтвердить участие</button>` : ""}

        ${event.isParticipant ? 
            `<button onclick="cancel()">Отменить участие</button>` : ""}
    `;
}

function join() {
    if (event.limit && event.participants >= event.limit) {
        alert("Достигнут максимальный лимит участников");
        return;
    }
    event.isParticipant = true;
    event.participants++;
    render();
}

function cancel() {
    if (confirm("Вы уверены, что хотите отменить участие?")) {
        event.isParticipant = false;
        event.participants--;
        render();
    }
}

render();