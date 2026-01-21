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

document.addEventListener("DOMContentLoaded", () => {
    const updateModal = document.getElementById("modalUpdate");
    const tableBody = document.querySelector("#table_section table tbody");
    const updateForm = document.getElementById("doctorFormUpdate");


    tableBody.addEventListener("click", (e) => {
        const btn = e.target.closest(".edit-btn");
        if (!btn) return;

        const row = btn.closest("tr");
        const uid = btn.dataset.uid;
        const email = btn.dataset.email;

        const name = row.children[0].innerText.replace("Dr. ", "");
        const specialization = row.children[2].innerText;
        const phone = row.children[3].innerText;

        document.getElementById("doc_name_update").value = name;
        document.getElementById("doc_email_update").value = email;
        document.getElementById("doc_specialization_update").value = specialization;
        document.getElementById("doc_phone_update").value = phone;

        document.getElementById("doctor_email_hidden").value = email;
        document.getElementById("doctor_uid_hidden").value = uid;


        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/Doc_House/controller/Admin/DoctorController.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    const data = JSON.parse(xhr.responseText);
                    document.getElementById("doc_fee_update").value = data.fee || '';
                    document.getElementById("doc_pass_update").value = data.pass || '';
                    document.getElementById("doc_bio_update").value = data.bio || '';
                } catch (e) {
                    console.error("Invalid JSON response:", xhr.responseText);
                }
            }
        };
        xhr.send('action=getDoctor&doctor_email=' + encodeURIComponent(email));

        updateModal.classList.add("active");
    });


    document.querySelector(".close-update").addEventListener("click", () => {
        updateModal.classList.remove("active");
        updateForm.reset();
    });


    updateForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const nameInput = document.getElementById("doc_name_update");
        const specializationInput = document.getElementById("doc_specialization_update");
        const phoneInput = document.getElementById("doc_phone_update");
        const feeInput = document.getElementById("doc_fee_update");
        const passInput = document.getElementById("doc_pass_update");

        let valid = true;


        if (nameInput.value.trim() === "") {
            showError(nameInput, "Enter doctor name");
            valid = false;
        } else {
            clearError(nameInput);
        }


        if (specializationInput.value.trim() === "") {
            showError(specializationInput, "Enter specialization");
            valid = false;
        } else {
            clearError(specializationInput);
        }


        const phone = phoneInput.value.trim();
        if (phone === "") {
            showError(phoneInput, "Enter phone number");
            valid = false;
        } else if (!/^\+?\d{10,15}$/.test(phone)) {
            showError(phoneInput, "Enter valid phone number (10-15 digits)");
            valid = false;
        } else {
            clearError(phoneInput);
        }


        const fee = feeInput.value.trim();
        if (fee === "" || isNaN(fee) || Number(fee) < 0) {
            showError(feeInput, "Enter valid fee");
            valid = false;
        } else {
            clearError(feeInput);
        }


        const pass = passInput.value.trim();
        if (pass && pass.length < 6) {
            showError(passInput, "Password must be at least 6 characters");
            valid = false;
        } else {
            clearError(passInput);
        }

        if (!valid) return;


        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/Doc_House/controller/Admin/DoctorController.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        const params = new URLSearchParams();
        params.append("action", "updateDoctor");
        params.append("uid", document.getElementById("doctor_uid_hidden").value);
        params.append("name", nameInput.value.trim());
        params.append("specialization", specializationInput.value.trim());
        params.append("phone", phoneInput.value.trim());
        params.append("fee", feeInput.value.trim());
        params.append("password", pass);
        params.append("bio", document.getElementById("doc_bio_update").value.trim());

        xhr.onload = function() {
            if (xhr.status === 200) {
                const res = xhr.responseText.trim();
                console.log(res);
                
                if (res === "updated") {
                    showToast("Doctor updated successfully", "success");

                    const row = document.querySelector(`.edit-btn[data-uid="${document.getElementById("doctor_uid_hidden").value}"]`).closest("tr");
                    row.children[0].textContent = nameInput.value.trim();
                    row.children[2].textContent = specializationInput.value.trim();
                    row.children[3].textContent = phoneInput.value.trim();

                    updateModal.classList.remove("active");
                    updateForm.reset();
                } else {
                    showToast("Update failed", "error");
                }
            } else {
                showToast("Server error", "error");
            }
        };

        console.log(params.toString());
        
        xhr.send(params.toString());
    });
});
