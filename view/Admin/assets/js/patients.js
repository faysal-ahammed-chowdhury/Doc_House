const form = document.getElementById("doctorFilterBar");


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

form.addEventListener('submit', (e) => {
    e.preventDefault();

    let valid = true;
    const email = document.getElementById('searchDoctor');
    const date = document.getElementById('regDate');
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const dateRegex = /^\d{4}-\d{2}-\d{2}$/;

    if (!email.value.trim()) {
        showError(email, `Enter Doctor Email Address`);
        valid = false;
        return;
    }
    else if (!emailRegex.test(email.value.trim())) {
        showError(email, "Enter A Valid Email Address");
        valid = false;
        return;
    }
    else {
        clearError(email);
        valid = true;
    }

    if (!date.value.trim()) {
        showError(date, `Select Registration Date`);
        valid = false;
        return;
    }
    else if(!dateRegex.test(date.value.trim())){
        showError(date, `Enter a Valid Date`);
        valid = false;
        return;
    }
    else {
        clearError(date);
        valid = true;
    }

})