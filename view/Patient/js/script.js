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

  return ok;
}

function getData(url, callback) {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", url);
  xhr.send();

  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      callback(null, JSON.parse(xhr.response));
    } else {
      callback(new Error("Request failed with status " + xhr.status));
    }
  };

  xhr.onerror = function () {
    callback(new Error("Network error"));
  };
}

function to12Hour(time24) {
  const [hourStr, minute, second] = time24.split(":");
  let hour = parseInt(hourStr);
  const ampm = hour >= 12 ? "PM" : "AM";
  hour = hour % 12 || 12;
  return hour + ":" + minute + " " + ampm;
}

function loadAvailableSlots(selectBox) {
  const slotBox = document.getElementById("slot");
  while (slotBox.children.length > 1) {
    slotBox.removeChild(slotBox.lastChild);
  }

  if (!isNaN(parseInt(selectBox.value.trim()))) {
    const sesId = parseInt(selectBox.value.trim());
    // console.log("../../../controller/Patient/slotController.php?sid=" + sesId);

    getData(
      "/Doc_House/controller/Patient/slotController.php?sid=" + sesId,
      function (err, data) {
        if (err) {
          alert(err);
          console.error(err);
          return;
        }
        for (let i = 0; i < data.length; i++) {
          // console.log("here", data[i]);
          const el = document.createElement("option");
          el.value = data[i];
          el.innerText = to12Hour(data[i]);
          slotBox.appendChild(el);
        }
      }
    );
  }
}
