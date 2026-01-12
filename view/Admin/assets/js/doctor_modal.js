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





const form = document.getElementById("doctorForm");


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


form.addEventListener("submit", (e) => {
    e.preventDefault();
    let valid = true;
    const email = document.getElementById('doc_email');
    const pass = document.getElementById('doc_pass');
    const name = document.getElementById('doc_name');
    const specialization = document.getElementById('doc_specialization');
    const fee = document.getElementById('doc_fee');
    const phone = document.getElementById('doc_phone');
    const bio = document.getElementById('doc_bio');

    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const phoneRegex = /^\+?[1-9]\d{1,14}$/;
    const numberRegex = /^[1-9]\d*$/;

    if (!email.value.trim()) {
        showError(email, `Enter Your Email Address`);
        valid = false;
        return;
    } else if (!emailRegex.test(email.value.trim())) {
        showError(email, "Enter A Valid Email Address");
        valid = false;
        return;
    }
    else {
        clearError(email);
        valid = true;
    }


    if (!pass.value.trim()) {
        showError(pass, `Ente Your Password`);
        valid = false;
        return;
    } else if (pass.value.trim().length < 6) {
        showError(pass, "Password must be at least 6 characters");
        valid = false;
        return;
    } else {
        clearError(pass);
        valid = true;
    }

    if (!name.value.trim()) {
        showError(name, `Ente Your Name`);
        valid = false;
        return;
    } else {
        clearError(name);
        valid = true;
    }

    if (!specialization.value.trim()) {
        showError(specialization, `Ente Your Specialization`);
        valid = false;
        return;
    } else {
        clearError(specialization);
        valid = true;
    }

    if (!fee.value.trim()) {
        showError(fee, `Ente Your Fee`);
        valid = false;
        return;
    } else if (!numberRegex.test(fee.value.trim())) {
        showError(fee, `Fees Must Be a Number`);
        valid = false;
        return;
    }
    else {
        clearError(fee);
        valid = true;
    }


    if (!phone.value.trim()) {
        showError(phone, `Ente Your Phone Number`);
        valid = false;
        return;
    } else if (!phoneRegex.test(phone.value.trim()) && phone.value.trim().length < 11) {
        showError(phone, `Ente A Valid Phone Number`);
        valid = false;
        return;
    }
    else {
        clearError(phone);
        valid = true;
    }


    if (!bio.value.trim()) {
        showError(bio, `Ente Your Bio`);
        valid = false;
        return;
    } else {
        clearError(bio);
        valid = true;
    }


    if (valid) {
        form.submit();
    }
});
