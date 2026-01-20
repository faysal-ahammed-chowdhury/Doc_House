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




//--------------- form validation --------------------
const form = document.getElementById("adminForm");


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
    const email = document.getElementById('admin_email');
    const pass = document.getElementById('admin_pass');
    const name = document.getElementById('admin_name');
    const phone = document.getElementById('admin_phone');
    const dob = document.getElementById('admin_dob');

    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

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


    if (!phone.value.trim()) {
        showError(phone, 'Enter your phone number');
        valid = false;
    } else {
        // Remove non-digit characters for validation
        const cleanPhone = phone.value.replace(/\D/g, '');

        if (cleanPhone.length < 11 || cleanPhone.length > 15) {
            showError(phone, 'Enter a valid phone number (11-15 digits)');
            valid = false;
        } else {
            clearError(phone);
            valid = true;
        }
    }

    if(!dob.value)
    {
        showError(dob, `Ente Your DOB`);
        valid = false;
        return;
    } else {
        clearError(dob);
        valid = true;
    }


    if (valid) {
        form.submit();
    }
});





//------------- filter -------------------
document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("searchAdmin");
    const tableBody = document.querySelector("#table_section table tbody");

   
    function fetchAdmins() {
        const search = searchInput.value.trim();

        const xhr = new XMLHttpRequest();
        

        xhr.open("POST", "/Doc_House/controller/Admin/AdminController.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function () {
            if (xhr.status === 200) {
                try {
                    const data = JSON.parse(xhr.responseText);

                    if (data.status === "success" && data.admins.length > 0) {
                        renderTable(data.admins);
                    } else {
                        tableBody.innerHTML = `<tr><td colspan="5">No admin found</td></tr>`;
                    }
                } catch (e) {
                    console.error("Invalid JSON response:", xhr.responseText);
                }
            } else {
                console.error("AJAX request failed");
            }
        };

        xhr.send(
            "action=filterDoctors&search=" +
            encodeURIComponent(search)
        );
    }

    
    function renderTable(admins) {
        tableBody.innerHTML = admins
            .map(admin => `
                <tr>
                    <td>Dr. ${admin.name}</td>
                    <td>${admin.email}</td>
                    <td>${admin.phone}</td>
                    <td>${admin.dob}</td>
                    <td>
                        <button class="edit_btn" data-uid="${admin.uid}" data-email="${admin.email}">
                            <i class="ri-edit-2-fill"></i>
                        </button>
                        <button class="delete_btn" data-uid="${admin.uid}">
                            <i class="ri-delete-bin-6-fill"></i>
                        </button>
                    </td>
                </tr>
            `)
            .join("");
    }

    
    searchInput.addEventListener("input", fetchAdmins);
    // specializationSelect.addEventListener("change", fetchAdmins);

    document.getElementById("AdminFilterBar").addEventListener("click", fetchAdmins);
});



// -------------- Update ----------------
const uidInput   = document.getElementById("admin_uid_u");
const hEmail     = document.getElementById("h_admin_email_u");
const emailInput = document.getElementById("admin_email_u");
const nameInput  = document.getElementById("admin_name_u");
const phoneInput = document.getElementById("admin_phone_u");
const dobInput   = document.getElementById("admin_dob_u");

const updateModal = document.getElementById("modalUpdate");
const updateForm  = document.getElementById("adminUpdateForm");
let closeModalBtn = document.querySelector(".close-update-btn");
const specUpdateError = document.getElementById("specUpdateError");



document.addEventListener("click", function (e) {
    const editBtn = e.target.closest(".edit_btn");
    if (!editBtn) return;

    const row = editBtn.closest("tr");

    uidInput.value   = editBtn.dataset.uid;
    hEmail.value     = row.children[1].textContent.trim(); // hidden input
    emailInput.textContent = row.children[1].textContent.trim();
    nameInput.value  = row.children[0].textContent.trim();
    phoneInput.value = row.children[2].textContent.trim();


    let dobText = row.children[3].textContent.trim();
    let dob = new Date(dobText);
    let yyyy = dob.getFullYear();
    let mm = String(dob.getMonth() + 1).padStart(2, '0');
    let dd = String(dob.getDate()).padStart(2, '0');
    dobInput.value = `${yyyy}-${mm}-${dd}`;

    updateModal.classList.add("active");
});


closeModalBtn.addEventListener("click", function () {
    updateModal.classList.remove("active");
    updateForm.reset();
    specUpdateError.textContent = "";
});


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
    if (span) span.textContent = "";
}


updateForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const uid   = uidInput.value;
    const email = hEmail.value; 
    const name  = nameInput.value.trim();
    const phone = phoneInput.value.trim();
    const dob   = dobInput.value;


    if (!name) { showError(nameInput, "Enter your name"); return; } else clearError(nameInput);
    if (!phone) { showError(phoneInput, "Enter your phone"); return; } else clearError(phoneInput);
    if (!dob) { showError(dobInput, "Select your DOB"); return; } else clearError(dobInput);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/Doc_House/controller/Admin/AdminController.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (xhr.status === 200) {
            const res = xhr.responseText.trim();
            if (res === "updated") {
                const row = document.querySelector(`.edit_btn[data-uid="${uid}"]`).closest("tr");
                row.children[0].textContent = name;
                row.children[2].textContent = phone;

                // Format DOB as "M d, Y"
                const dob = new Date(dobInput.value);
                const options = { month: "short", day: "2-digit", year: "numeric" };
                row.children[3].textContent = dob.toLocaleDateString("en-US", options);

                showToast("Admin updated successfully", "success");
                updateModal.classList.remove("active");
            } else {
                specUpdateError.textContent = "Update failed!";
            }
        } else {
            specUpdateError.textContent = "Server error!";
        }
    };

    const params = `action=update&uid=${encodeURIComponent(uid)}&admin_name=${encodeURIComponent(name)}&admin_email=${encodeURIComponent(email)}&admin_phone=${encodeURIComponent(phone)}&admin_dob=${encodeURIComponent(dob)}`;
    xhr.send(params);
});






// ------------- delete ----------------

document.addEventListener("DOMContentLoaded", function () {
  let selectedUid = null;


  document.addEventListener("click", function (e) {
    const deleteBtn = e.target.closest(".delete_btn");
    if (!deleteBtn) return;

    selectedUid = deleteBtn.dataset.uid;
    document.getElementById("deleteModal").classList.add("active");
  });


  document.getElementById("cancelDelete").addEventListener("click", function () {
    document.getElementById("deleteModal").classList.remove("active");
    selectedUid = null;
  });


  document.getElementById("confirmDelete").addEventListener("click", function () {
    if (!selectedUid) return;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/Doc_House/controller/Admin/AdminController.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
      if (xhr.status === 200) {
        const res = xhr.responseText.trim();

        if (res === "delete") {
          const row = document.querySelector(`.delete_btn[data-uid="${selectedUid}"]`)?.closest("tr");
          if (row) row.remove();
          showToast("Admin deleted successfully", "success");
        } else {
          showToast(res, "error");
        }

        document.getElementById("deleteModal").classList.remove("active");
        selectedUid = null;
      } else {
        showToast("Request failed with status " + xhr.status, "error");
      }
    };

    xhr.send("action=deleteAdmin&uid=" + encodeURIComponent(selectedUid));
  });
});