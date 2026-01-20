document.addEventListener("DOMContentLoaded", () => {
    const updateModal = document.getElementById("modalUpdate");
    const tableBody = document.querySelector("#table_section table tbody");

    // Event delegation for edit buttons
    tableBody.addEventListener("click", (e) => {
        const btn = e.target.closest(".edit-btn");
        if (!btn) return; // click wasn't on edit button

        const row = btn.closest("tr");
        const uid = btn.dataset.uid;
        const email = btn.dataset.email;

        // fill inputs
        const name = row.children[0].innerText.replace("Dr. ", "");
        const specialization = row.children[2].innerText;
        const phone = row.children[3].innerText;

        document.getElementById("doc_name_update").value = name;
        document.getElementById("doc_email_update").value = email;
        document.getElementById("doc_specialization_update").value = specialization;
        document.getElementById("doc_phone_update").value = phone;

        // hidden inputs
        document.getElementById("doctor_email_hidden").value = email;
        document.getElementById("doctor_uid_hidden").value = uid;

        // fetch fee, pass, bio
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

        // show modal
        updateModal.classList.add("active");
    });

    // close button
    document.querySelector(".close-update").addEventListener("click", () => {
        updateModal.classList.remove("active");
    });
});
