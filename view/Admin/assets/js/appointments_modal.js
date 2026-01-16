const modal = document.getElementById("modal");
const openBtn = document.getElementById("openModal");
const closeBtn = document.querySelector(".close-btn");

openBtn.addEventListener("click", () => {
    modal.classList.add("active");
});

closeBtn.addEventListener("click", () => {
    modal.classList.remove("active");
});


document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
        modal.classList.remove("active");
    }
});


modal.addEventListener("click", (e) => {
    if (e.target === modal) {
        modal.classList.remove("active");
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modal");
    const shouldOpen = document.body.dataset.openModal === "true";

    if (shouldOpen && modal) {
        modal.classList.add("active");
    }
});


const appointmentForm = document.getElementById("appointmentForm");
const doctorFilterBar = document.getElementById('doctorFilterBar');

function showError(input, message) {
    let span = input.parentElement.querySelector("span");
    if (!span) {
        span = document.createElement("span");
        span.classList.add("error-message");
        input.parentElement.appendChild(span);
    }
    span.textContent = message;
}

function clearError(input) {
    const span = input.parentElement.querySelector("span");
    if (span) {
        span.textContent = "";
    }
}

appointmentForm.addEventListener("submit", (e) => {
    e.preventDefault();
    let valid = true;

    const patientName = document.getElementById("patient_name");
    const doctorName = document.getElementById("doc_name");
    const totalTime = document.getElementById("doc_total_time");
    const availableSlot = document.getElementById("doc_available_slot");
    const status = document.getElementById("status");

    if (!patientName.value.trim()) {
        showError(patientName, "Enter Patient Name");
        valid = false;
        return;
    } else {
        clearError(patientName);
    }

    if (!doctorName.value.trim()) {
        showError(doctorName, "Select Doctor Name");
        valid = false;
        return;
    } else {
        clearError(doctorName);
    }

    if (!totalTime.value.trim()) {
        showError(totalTime, "Select Available Session");
        valid = false;
        return;
    } else {
        clearError(totalTime);
    }

    if (!availableSlot.value.trim()) {
        showError(availableSlot, "Select Available Slot");
        valid = false;
        return;
    } else {
        clearError(availableSlot);
    }

    if (!status.value.trim()) {
        showError(status, "Select Appointment Status");
        valid = false;
        return;
    } else {
        clearError(status);
    }


    if (valid) {
        appointmentForm.submit();
    }
});










