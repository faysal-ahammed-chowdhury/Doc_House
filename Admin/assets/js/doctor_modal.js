const modal = document.getElementById("modal");
const openBtn = document.getElementById("openModal");
const closeBtn = document.querySelector(".close-btn");

openBtn.addEventListener("click", () => {
modal.classList.add("active");
});

closeBtn.addEventListener("click", () => {
modal.classList.remove("active");
});

// Close on ESC key
document.addEventListener("keydown", (e) => {
if (e.key === "Escape") {
    modal.classList.remove("active");
}
});

// Close on background click
modal.addEventListener("click", (e) => {
if (e.target === modal) {
    modal.classList.remove("active");
}
});
