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


  return ok;
}

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
