let selectedUId = null;
let selectedRow = null;

document.addEventListener("click", function (e) {
  const deleteBtn = e.target.closest(".delete_btn");
  if (!deleteBtn) return;

  selectedUId = deleteBtn.dataset.uid;
  selectedRow = deleteBtn.closest("tr");
  document.getElementById("deleteModal").classList.add("active");
});

document.getElementById("cancelDelete").addEventListener("click", () => {
  document.getElementById("deleteModal").classList.remove("active");
  selectedUId = null;
  selectedRow = null;
});

document.getElementById("confirmDelete").addEventListener("click", () => {
  if (!selectedUId) return;

  const xhr = new XMLHttpRequest();
  xhr.open(
    "POST",
    "/Doc_House/controller/Admin/DoctorController.php",
    true
  );
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (xhr.status === 200) {
      try {
        const data = JSON.parse(xhr.responseText);
        if (data.status === "success") {
          // remove the row
          selectedRow.remove();

          showToast(data.message, "success");
        } else {
          showToast(data.message, "error");
        }
      } catch (e) {
        showToast("Invalid server response", "error");
      }

      document.getElementById("deleteModal").classList.remove("active");
      selectedUId = null;
      selectedRow = null;
    } else {
      showToast("Failed to delete doctor", "error");
    }
  };

  xhr.send("action=deleteDoctor&uid=" + encodeURIComponent(selectedUId));
});
