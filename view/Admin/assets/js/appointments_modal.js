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


doctorFilterBar.addEventListener('submit', (e) => {

    e.preventDefault();
    let valid = true;

    const pName = document.getElementById('pName');
    const dName = document.getElementById('dName');
    const status = document.getElementById('appointmentStatus');
    const date = document.getElementById('date');

    const dateRegex = /^\d{4}-\d{2}-\d{2}$/;

    console.log(status.value);

    if (!pName.value.trim()) {
        showError(pName, "Enter Patient Name");
        valid = false;
        return;
    } else {
        clearError(pName);
        valid = true;
    }

    if (!dName.value.trim()) {
        showError(dName, "Enter Doctor Name");
        valid = false;
        return;
    } else {
        clearError(dName);
        valid = true;
    }

    if (!status.value.trim()) {
        showError(status, "Select Status");
        valid = false;
        return;
    } else {
        clearError(status);
        valid = true;
    }

    if (!date.value.trim()) {
        showError(date, "Enter Appointment Date");
        valid = false;
        return;
    }
    else if (!dateRegex.test(date.value.trim())) {
        showError(date, `Enter a Valid Date`);
        valid = false;
        return;
    }
    else {
        clearError(date);
        valid = true;
    }

    if(valid)
    {
        doctorFilterBar.submit();
    }

})


