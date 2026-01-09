const phoneRegex = /^[0-9]{11}$/;

function handleUpdateProfile(pForm) {
  const name = pForm.fullname.value.trim();
  const nameErrorBox = document.getElementById("nameErrBox");

  const phone = pForm.phone.value.trim();
  const phoneErrorBox = document.getElementById("phoneErrBox");

  const pass = pForm.password.value.trim();
  const passErrorBox = document.getElementById("passErrBox");

  const cpass = pForm.cpassword.value.trim();
  const cpassErrorBox = document.getElementById("cpassErrBox");

  const dob = pForm.dob.value.trim();
  const dobErrorBox = document.getElementById("dobErrBox");

  const gender = pForm.gender.value.trim();
  const genderErrorBox = document.getElementById("genderErrBox");

  const weight = pForm.weight.value.trim();
  const weightErrorBox = document.getElementById("weightErrBox");

  let ok = true;
  // name
  if (name === "") {
    ok = false;
    nameErrorBox.innerText = "Name is required";
    nameErrorBox.classList.remove("hidden");
  } else {
    nameErrorBox.classList.add("hidden");
  }

  // phone
  if (phone === "") {
    ok = false;
    phoneErrorBox.innerText = "Phone is required";
    phoneErrorBox.classList.remove("hidden");
  } else if (!phoneRegex.test(phone)) {
    ok = false;
    phoneErrorBox.innerText = "Invalid Phone";
    phoneErrorBox.classList.remove("hidden");
  } else {
    phoneErrorBox.classList.add("hidden");
  }

  // pass
  if (pass !== "" && pass.length < 8) {
    ok = false;
    passErrorBox.innerText = "Password must be at least 8 characters";
    passErrorBox.classList.remove("hidden");
  } else {
    passErrorBox.classList.add("hidden");
  }

  // confirm pass
  if (pass !== "" && cpass === "") {
    ok = false;
    cpassErrorBox.innerText = "Confirm Password is required";
    cpassErrorBox.classList.remove("hidden");
  } else if (pass !== "" && pass !== cpass) {
    ok = false;
    cpassErrorBox.innerText = "Passwords did not matched";
    cpassErrorBox.classList.remove("hidden");
  } else {
    cpassErrorBox.classList.add("hidden");
  }

  // dob
  if (dob === "") {
    ok = false;
    dobErrorBox.innerText = "DOB is required";
    dobErrorBox.classList.remove("hidden");
  } else {
    dobErrorBox.classList.add("hidden");
  }

  // gender
  if (gender === "") {
    ok = false;
    genderErrorBox.innerText = "Gender is required";
    genderErrorBox.classList.remove("hidden");
  } else {
    genderErrorBox.classList.add("hidden");
  }

  // weight
  if (weight === "") {
    ok = false;
    weightErrorBox.innerText = "Weight is required";
    weightErrorBox.classList.remove("hidden");
  } else {
    weightErrorBox.classList.add("hidden");
  }

  return ok;
}

function to12Hour(time24) {
  const [hourStr, minute, second] = time24.split(":");
  let hour = parseInt(hourStr);
  const ampm = hour >= 12 ? "PM" : "AM";
  hour = hour % 12 || 12;
  return hour + ":" + minute + " " + ampm;
}

// load slots for selected session
function loadAvailableSlots(selectBox) {
  const slotBox = document.getElementById("slot");
  while (slotBox.children.length > 1) {
    slotBox.removeChild(slotBox.lastChild);
  }

  if (!isNaN(parseInt(selectBox.value.trim()))) {
    const sesId = parseInt(selectBox.value.trim());
    // console.log("../../../controller/Patient/slotController.php?sid=" + sesId);

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
      const data = JSON.parse(xhttp.response);
      if (xhttp.status >= 200 && xhttp.status < 300) {
        for (let i = 0; i < data.times.length; i++) {
          // console.log("here", data.times[i]);
          const el = document.createElement("option");
          el.value = data.times[i];
          el.innerText = to12Hour(data.times[i]);
          slotBox.appendChild(el);
        }
      } else {
        alert(data.message);
      }
    };

    xhttp.open(
      "GET",
      "/Doc_House/controller/Patient/slotController.php?sid=" + sesId
    );
    xhttp.send();
  }
}

// profile edit and display
function showDisplayMode() {
  const displayMode = document.getElementById("displayMode");
  const editMode = document.getElementById("editMode");
  editMode.classList.add("hidden");
  displayMode.classList.remove("hidden");
}
function showEditMode() {
  const displayMode = document.getElementById("displayMode");
  const editMode = document.getElementById("editMode");
  displayMode.classList.add("hidden");
  editMode.classList.remove("hidden");
}

// display toast message
function showToast(message, type, duration = 3000) {
  const toast = document.querySelector(".toast-box");
  const msg = document.getElementById("toast-msg");

  msg.innerText = message;
  toast.classList.add("show");
  toast.classList.add("toast-" + type);

  setTimeout(() => {
    toast.classList.remove("show");
    toast.classList.remove("toast-" + type);
  }, duration);
}

// cancel appointment
function cancelAppointment(aptid) {
  // console.log(aptid);
  if (!isNaN(parseInt(aptid))) {
    console.log(aptid);
    aptid = parseInt(aptid);
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
      data = JSON.parse(xhttp.response);
      console.log(data);

      showToast(data.message, data.status, 5000);

      if (data.status == "success") {
        const el = document.getElementById("apt-" + aptid);
        el.getElementsByClassName("status")[0].innerHTML = "CANCELLED";
        el.getElementsByClassName("status")[0].classList.add("cancelled");
        el.getElementsByClassName("status")[0].classList.remove("pending");
        el.getElementsByClassName("actions")[0].innerHTML = "";
      }
    };

    xhttp.open(
      "POST",
      "/Doc_House/controller/Patient/cancelAppointmentController.php"
    );
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("aptid=" + aptid);
  } else {
    showAppointmentToast("Invalid Appointment ID", "warning", 5000);
  }
}

// check valid time like 14:45:00
function isValidTime(time) {
  let arr = time.split(":");
  if (arr.length != 3) return false;
  let hour = arr[0];
  let min = arr[1];
  let sec = arr[2];

  if (isNaN(parseInt(hour)) || isNaN(parseInt(min)) || isNaN(parseInt(sec)))
    return false;

  if (parseInt(hour) >= 24 || parseInt(min) >= 60 || parseInt(sec) >= 60)
    return false;

  if (parseInt(hour) < 0 || parseInt(min) < 0 || parseInt(sec) < 0)
    return false;

  return true;
}

// book appointment
function bookAppointment(pForm) {
  const sessionId = pForm.session.value.trim();
  const timeSlot = pForm.slot.value.trim();
  console.log(sessionId);
  console.log(timeSlot);

  if (sessionId == "" || timeSlot == "") {
    showToast("Select a session and time slot", "warning", 5000);
    return false;
  }

  if (isNaN(parseInt(sessionId))) {
    showToast("Invalid Session", "error", 5000);
    return false;
  }

  if (!isValidTime(timeSlot)) {
    showToast("Invalid Time Slot", "error", 5000);
    return false;
  }

  const xhttp = new XMLHttpRequest();
  xhttp.onload = function () {
    data = JSON.parse(xhttp.response);
    console.log(data);
    showToast(data.message, data.status, 5000);
  };

  xhttp.open(
    "POST",
    "/Doc_House/controller/Patient/bookAppointmentController.php"
  );
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("sid=" + sessionId + "&timeSlot=" + timeSlot);

  return false;
}
