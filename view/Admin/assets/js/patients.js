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
    xhr.open("POST", "/Doc_House/controller/Admin/PatientController.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
      if (xhr.status === 200) {
        const res = xhr.responseText.trim();

        if (res === "delete") {
          const row = document.querySelector(`.delete_btn[data-uid="${selectedUid}"]`)?.closest("tr");
          if (row) row.remove();
          showToast("Patient deleted successfully", "success");
        } else {
          showToast(res, "error");
        }

        document.getElementById("deleteModal").classList.remove("active");
        selectedUid = null;
      } else {
        showToast("Request failed with status " + xhr.status, "error");
      }
    };

    xhr.send("action=deletePatient&uid=" + encodeURIComponent(selectedUid));
  });
});



document.getElementById("searchDoctor").addEventListener("keyup", function () {
  const keyword = this.value.trim();

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "/Doc_House/controller/Admin/PatientController.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (xhr.status === 200) {
      document.querySelector("#table_section table").innerHTML = xhr.responseText;
    }
  };

  xhr.send("action=searchPatient&keyword=" + encodeURIComponent(keyword));
});
