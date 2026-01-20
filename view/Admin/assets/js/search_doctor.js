document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("searchDoctor");
    const specializationSelect = document.getElementById("doctorSpecialization");
    const tableBody = document.querySelector("#table_section table tbody");

   
    function fetchDoctors() {
        const search = searchInput.value.trim();
        const specialization = specializationSelect.value.trim();

        const xhr = new XMLHttpRequest();
        

        xhr.open("POST", "/Doc_House/controller/Admin/DoctorController.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function () {
            if (xhr.status === 200) {
                try {
                    const data = JSON.parse(xhr.responseText);

                    if (data.status === "success" && data.doctors.length > 0) {
                        renderTable(data.doctors);
                    } else {
                        tableBody.innerHTML = `<tr><td colspan="5">No doctors found</td></tr>`;
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
            encodeURIComponent(search) +
            "&specialization=" +
            encodeURIComponent(specialization)
        );
    }

    
    function renderTable(doctors) {
        tableBody.innerHTML = doctors
            .map(doctor => `
                <tr>
                    <td>Dr. ${doctor.name}</td>
                    <td>${doctor.email}</td>
                    <td>${doctor.specialization}</td>
                    <td>${doctor.phone}</td>
                    <td>
                        <button class="edit-btn" data-uid="${doctor.uid}" data-email="${doctor.email}">
                            <i class="ri-edit-2-fill"></i>
                        </button>
                        <button class="delete_btn" data-uid="${doctor.uid}">
                            <i class="ri-delete-bin-6-fill"></i>
                        </button>
                    </td>
                </tr>
            `)
            .join("");
    }

    
    searchInput.addEventListener("input", fetchDoctors);
    specializationSelect.addEventListener("change", fetchDoctors);

    document.getElementById("applyDoctorFilter").addEventListener("click", fetchDoctors);

    document.getElementById("resetDoctorFilter").addEventListener("click", () => {
        searchInput.value = "";
        specializationSelect.value = "";
        fetchDoctors();
    });
});
