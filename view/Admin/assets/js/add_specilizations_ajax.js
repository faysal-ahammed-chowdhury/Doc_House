const specInput = document.getElementById("specialization");
const specError = document.getElementById("specError");
const addBtn = document.getElementById("addSpecBtn");

addBtn.addEventListener("click", function (e) {
    e.preventDefault();

    const specName = specInput.value.trim();
    if (specName === "") {
        specError.textContent = "Enter Specialization First";
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open(
        "POST",
        "/Doc_House/controller/Admin/SpecializationController.php",
        true
    );
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (xhr.status === 200) {
            const res = xhr.responseText.trim();

            if (res === "added") {
                specError.textContent = "";
                showToast("Specialization added successfully", "success");

                // Clear input
                specInput.value = "";

                const tableBody = document.querySelector("#table_section table tbody");
                if (tableBody) {
                    const newRow = document.createElement("tr");
                    newRow.innerHTML = `
                        <td>
                            <div>
                                <div><h4><i class="ri-brain-2-line"></i></h4></div>
                                <div><h4>${specName}</h4></div>
                            </div>
                        </td>
                        <td>0 Doctors</td>
                        <td>
                            <button data-spid="" class="edit_btn"><i class="ri-edit-2-fill"></i></button>
                            <button data-spid="" class="delete_btn"><i class="ri-delete-bin-6-fill"></i></button>
                        </td>
                    `;
                    tableBody.appendChild(newRow);
                }

            } else {
                specError.textContent = "Failed to add specialization.";
            }
        } else {
            specError.textContent = "Server error.";
        }
    };

    xhr.send("action=add_ajax&specialization=" + encodeURIComponent(specName));
});




