function showToast(message, type = "success", duration = 3000) {
  const toast = document.getElementById("toast");

  toast.textContent = message;
  toast.className = `toast show ${type}`;

  setTimeout(() => {
    toast.className = "toast";
  }, duration);
}
