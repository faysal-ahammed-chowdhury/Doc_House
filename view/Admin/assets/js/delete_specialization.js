let selectedSpid = null;


document.addEventListener("click", function (e) {
  const deleteBtn = e.target.closest(".delete_btn");
  if (!deleteBtn) return;

  selectedSpid = deleteBtn.dataset.spid;
  document.getElementById("deleteModal").classList.add("active");
});


document.getElementById("cancelDelete").addEventListener("click", function () {
  document.getElementById("deleteModal").classList.remove("active");
  selectedSpid = null;
});


document.getElementById("confirmDelete").addEventListener("click", function () {
  if (!selectedSpid) return;

  const xhr = new XMLHttpRequest();
  xhr.open(
    "POST",
    "/Doc_House/controller/Admin/SpecializationController.php",
    true,
  );
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (xhr.status === 200) {
      const res = xhr.responseText.trim();

      if (res === "has_doctors") {
        showToast("Cannot delete! Doctors are assigned.", "warning");
      } else if (res === "deleted") {
        const row = document
          .querySelector(`.delete_btn[data-spid="${selectedSpid}"]`)
          .closest("tr");
        row.remove();
        showToast("Specialization deleted successfully", "success");
      } else {
        showToast("Delete failed.", "error");
      }

      document.getElementById("deleteModal").classList.remove("active");
      selectedSpid = null;
    }
  };

  xhr.send("action=delete&spid=" + encodeURIComponent(selectedSpid));
});
