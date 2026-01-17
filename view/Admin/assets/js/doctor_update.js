document.addEventListener("DOMContentLoaded", () => {
    const updateModal = document.getElementById("modalUpdate");

    document.querySelectorAll(".edit-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            const row = btn.closest("tr");
            const uid = btn.dataset.uid;
            const email = btn.dataset.email;

            // fill input from table row
            const name = row.children[0].innerText.replace("Dr. ", "");
            const specialization = row.children[2].innerText;
            const phone = row.children[3].innerText;

            document.getElementById("doc_name_update").value = name;
            document.getElementById("doc_email_update").value = email;
            document.getElementById("doc_specialization_update").value = specialization;
            document.getElementById("doc_phone_update").value = phone;
            
            
            // set hidden input for form submission
            document.getElementById("doctor_email_hidden").value = email;
            document.getElementById("doctor_uid_hidden").value = btn.dataset.uid;

            // ajax to get fee, password, bio
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
                } else {
                    console.error("Failed to fetch doctor data");
                }
            };

            xhr.send('action=getDoctor&doctor_email=' + encodeURIComponent(email));


            updateModal.classList.add("active");
        });
    });


    document.querySelector(".close-update").addEventListener("click", () => {
        updateModal.classList.remove("active");
    });
});
