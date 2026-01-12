document.addEventListener("DOMContentLoaded", () => {
    const data = document.getElementById("toster-data");
    if (!data) return;

    const message = data.dataset.message;
    toster(message);
});

function createTosterContainer() {
    let container = document.querySelector('.toster-container');
    if (!container) {
        container = document.createElement('div');
        container.className = 'toster-container';
        document.body.appendChild(container);
    }
    return container;
}

function toster(message, duration = 3) {
    const container = createTosterContainer();

    const tosterEl = document.createElement('div');
    tosterEl.className = 'toster';
    tosterEl.innerText = message;

    container.appendChild(tosterEl);

    setTimeout(() => {
        tosterEl.remove();
    }, duration * 1000 + 500);
}
