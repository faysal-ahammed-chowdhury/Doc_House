let selectedAptId = null;

document.addEventListener("click", function (e) {
  const deleteBtn = e.target.closest("#delete_btn");
  if (!deleteBtn) return;

  selectedAptId = deleteBtn.dataset.aptid;
  document.getElementById("deleteModal").classList.add("active");
});


document.getElementById("cancelDelete").addEventListener("click", () => {
  document.getElementById("deleteModal").classList.remove("active");
  selectedAptId = null;
});


document.getElementById("confirmDelete").addEventListener("click", () => {
  if (!selectedAptId) return;

  const xhr = new XMLHttpRequest();
  xhr.open(
    "POST",
    "/Doc_House/controller/Admin/DeleteAppointmentController.php",
    true
  );
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (xhr.status === 200) {
      const tableBody = document.querySelector("#table_section table");
      tableBody.innerHTML = xhr.responseText;

      document.getElementById("deleteModal").classList.remove("active");
      selectedAptId = null;
      showToast("Appointment deleted successfully", "success");
    } else {
      alert("Failed to delete appointment.");
    }
  };

  xhr.send("aptid=" + encodeURIComponent(selectedAptId));
});
