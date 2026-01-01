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

    if (!email.value.trim()) {
        showError(email, `Enter Your Email Address`);
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
    } else {
        clearError(fee);
        valid = true;
    }


    if (!phone.value.trim()) {
        showError(phone, `Ente Your Phone Number`);
        valid = false;
        return;
    } else {
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
