const updateModal = document.getElementById("updateModal");
const specUpdateInput = document.getElementById("specializationUpdate");
const specUpdateId = document.getElementById("specializationUpdateId");
const specUpdateError = document.getElementById("specUpdateError");
const cancelBtn = document.getElementById("cancel-btn");
const updateForm = document.getElementById("updateSpecForm");


document.addEventListener("click", function (e) {
    const editBtn = e.target.closest(".edit_btn");
    if (!editBtn) return;

    const spid = editBtn.dataset.spid;
    const specName = editBtn.closest("tr").querySelector("td div div:nth-child(2) h4").textContent;

    specUpdateInput.value = specName;
    specUpdateId.value = spid;

    updateModal.classList.add("active");
});


cancelBtn.addEventListener("click", () => {
    updateModal.classList.remove("active");
    specUpdateError.textContent = "";
});

// ajax update
updateForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const spid = specUpdateId.value;
    const newName = specUpdateInput.value.trim();

    if (newName === "") {
        specUpdateError.textContent = "Enter Specialization Name";
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/Doc_House/controller/Admin/SpecializationController.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (xhr.status === 200) {
            const res = xhr.responseText.trim();

            if (res === "updated") {
                const row = document.querySelector(`.edit_btn[data-spid="${spid}"]`).closest("tr");
                row.querySelector("td div div:nth-child(2) h4").textContent = newName;

                showToast("Specialization updated successfully", "success");
                updateModal.classList.remove("active");
                specUpdateError.textContent = "";
            } else {
                specUpdateError.textContent = "Update failed!";
            }
        } else {
            specUpdateError.textContent = "Server error!";
        }
    };

    xhr.send(
        "action=update&spid=" + encodeURIComponent(spid) +
        "&name=" + encodeURIComponent(newName)
    );
});