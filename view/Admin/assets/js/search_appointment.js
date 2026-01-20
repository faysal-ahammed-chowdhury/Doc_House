const filterBtn = document.getElementById("applyDoctorFilter");
const resetBtn = document.getElementById("resetDoctorFilter");

const pNameInput = document.getElementById("pName");
const dNameInput = document.getElementById("dName");
const statusSelect = document.getElementById("appointmentStatus");
const dateInput = document.getElementById("date");


const tableBody = document.querySelector("#table_section table tbody");



pNameInput.addEventListener("keyup", (e) => {
  tableBody.innerHTML += '<tr><td colspan="5">Loading...</td></tr>';

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "/Doc_House/controller/Admin/FilterAppointment.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (xhr.status === 200) {
      tableBody.innerHTML = xhr.responseText;
    } else {
      alert("Failed to load appointments");
    }
  };

  const params =
    "pName=" +
    encodeURIComponent(pNameInput.value) +
    "&dName=" +
    encodeURIComponent(dNameInput.value) +
    "&status=" +
    encodeURIComponent(statusSelect.value) +
    "&date=" +
    encodeURIComponent(dateInput.value);

  xhr.send(params);
});



dNameInput.addEventListener("keyup", (e) => {
  tableBody.innerHTML += '<tr><td colspan="5">Loading...</td></tr>';

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "/Doc_House/controller/Admin/FilterAppointment.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (xhr.status === 200) {
      tableBody.innerHTML = xhr.responseText;
    } else {
      alert("Failed to load appointments");
    }
  };

  const params =
    "pName=" +
    encodeURIComponent(pNameInput.value) +
    "&dName=" +
    encodeURIComponent(dNameInput.value) +
    "&status=" +
    encodeURIComponent(statusSelect.value) +
    "&date=" +
    encodeURIComponent(dateInput.value);

  xhr.send(params);
});



statusSelect.addEventListener("change", () => {
  
  tableBody.innerHTML = '<tr><td colspan="5">Loading...</td></tr>';

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "/Doc_House/controller/Admin/FilterAppointment.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (xhr.status === 200) {
      console.log(xhr.responseText);
      tableBody.innerHTML = xhr.responseText;
    }
  };

  const params =
    "pName=" +
    encodeURIComponent(pNameInput.value) +
    "&dName=" +
    encodeURIComponent(dNameInput.value) +
    "&status=" +
    encodeURIComponent(statusSelect.value) +
    "&date=" +
    encodeURIComponent(dateInput.value);

  xhr.send(params);
  
});

dateInput.addEventListener("change", () => {
  tableBody.innerHTML = '<tr><td colspan="5">Loading...</td></tr>';

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "/Doc_House/controller/Admin/FilterAppointment.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (xhr.status === 200) {
      tableBody.innerHTML = xhr.responseText;
    }
  };

  const params =
    "pName=" +
    encodeURIComponent(pNameInput.value) +
    "&dName=" +
    encodeURIComponent(dNameInput.value) +
    "&status=" +
    encodeURIComponent(statusSelect.value) +
    "&date=" +
    encodeURIComponent(dateInput.value);

  xhr.send(params);
});



filterBtn.addEventListener("click", function (e) {
  e.preventDefault();

  tableBody.innerHTML += '<tr><td colspan="5">Loading...</td></tr>';

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "/Doc_House/controller/Admin/FilterAppointment.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = function () {
    if (xhr.status === 200) {
      tableBody.innerHTML = xhr.responseText;
    } else {
      alert("Failed to load appointments");
    }
  };

  const params =
    "pName=" +
    encodeURIComponent(pNameInput.value) +
    "&dName=" +
    encodeURIComponent(dNameInput.value) +
    "&status=" +
    encodeURIComponent(statusSelect.value) +
    "&date=" +
    encodeURIComponent(dateInput.value);

  xhr.send(params);
});

/* Reset */
resetBtn.addEventListener("click", function () {
  pNameInput.value = "";
  dNameInput.value = "";
  statusSelect.value = "";
  dateInput.value = "";

  filterBtn.click();
});
