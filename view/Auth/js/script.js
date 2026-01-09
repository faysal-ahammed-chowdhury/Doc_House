const emailRegex = /^[a-zA-Z0-9._]+@[a-zA-Z0-9.-]+\.[a-zA-Z]+$/;
const phoneRegex = /^[0-9]{11}$/;

function handleLogin(pForm) {
  const email = pForm.email.value.trim();
  const emailErrorBox = document.getElementById("emailErrBox");

  const pass = pForm.password.value.trim();
  const passErrorBox = document.getElementById("passErrBox");

  let ok = true;
  // email
  if (email === "") {
    ok = false;
    emailErrorBox.innerText = "Email is required";
    emailErrorBox.classList.remove("hidden");
  } else if (!emailRegex.test(email)) {
    ok = false;
    emailErrorBox.innerText = "Invalid Email";
    emailErrorBox.classList.remove("hidden");
  } else {
    emailErrorBox.classList.add("hidden");
  }

  // password
  if (pass === "") {
    ok = false;
    passErrorBox.innerText = "Password is required";
    passErrorBox.classList.remove("hidden");
  } else if (pass.length < 8) {
    ok = false;
    passErrorBox.innerText = "Password must be at least 8 characters";
    passErrorBox.classList.remove("hidden");
  } else {
    passErrorBox.classList.add("hidden");
  }

  return ok;
}

function handleRegister(pForm) {
  const name = pForm.name.value.trim();
  const nameErrorBox = document.getElementById("nameErrBox");

  const email = pForm.email.value.trim();
  const emailErrorBox = document.getElementById("emailErrBox");

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
  console.log(weightErrorBox);

  let ok = true;
  // name
  if (name === "") {
    ok = false;
    nameErrorBox.innerText = "Name is required";
    nameErrorBox.classList.remove("hidden");
  } else {
    nameErrorBox.classList.add("hidden");
  }

  // email
  if (email === "") {
    ok = false;
    emailErrorBox.innerText = "Email is required";
    emailErrorBox.classList.remove("hidden");
  } else if (!emailRegex.test(email)) {
    ok = false;
    emailErrorBox.innerText = "Invalid Email";
    emailErrorBox.classList.remove("hidden");
  } else {
    emailErrorBox.classList.add("hidden");
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
  if (pass === "") {
    ok = false;
    passErrorBox.innerText = "Password is required";
    passErrorBox.classList.remove("hidden");
  } else if (pass.length < 8) {
    ok = false;
    passErrorBox.innerText = "Password must be at least 8 characters";
    passErrorBox.classList.remove("hidden");
  } else {
    passErrorBox.classList.add("hidden");
  }

  // confirm pass
  if (cpass === "") {
    ok = false;
    cpassErrorBox.innerText = "Confirm Password is required";
    cpassErrorBox.classList.remove("hidden");
  } else if (pass !== cpass) {
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
  // if (weight === "") {
  //   ok = false;
  //   weightErrorBox.innerText = "Weight is required";
  //   weightErrorBox.classList.remove("hidden");
  // } else if (isNaN(parseInt(weight))) {
  //   ok = false;
  //   weightErrorBox.innerText = "Weight can not be text";
  //   weightErrorBox.classList.remove("hidden");
  // } else if (parseInt(weight) < 0) {
  //   ok = false;
  //   weightErrorBox.innerText = "Weight can not be negative";
  //   weightErrorBox.classList.remove("hidden");
  // } else {
  //   weightErrorBox.classList.add("hidden");
  // }

  return ok;
}

function handleForgotPass(pForm) {
  const email = pForm.email.value.trim();
  const emailErrorBox = document.getElementById("emailErrBox");

  const pass = pForm.new_password.value.trim();
  const passErrorBox = document.getElementById("newPassErrBox");

  const cpass = pForm.cnew_password.value.trim();
  const cpassErrorBox = document.getElementById("cnewPassErrBox");

  const dob = pForm.dob.value.trim();
  const dobErrorBox = document.getElementById("dobErrBox");

  let ok = true;

  // email
  if (email === "") {
    ok = false;
    emailErrorBox.innerText = "Email is required";
    emailErrorBox.classList.remove("hidden");
  } else if (!emailRegex.test(email)) {
    ok = false;
    emailErrorBox.innerText = "Invalid Email";
    emailErrorBox.classList.remove("hidden");
  } else {
    emailErrorBox.classList.add("hidden");
  }

  // pass
  if (pass === "") {
    ok = false;
    passErrorBox.innerText = "Password is required";
    passErrorBox.classList.remove("hidden");
  } else if (pass.length < 8) {
    ok = false;
    passErrorBox.innerText = "Password must be at least 8 characters";
    passErrorBox.classList.remove("hidden");
  } else {
    passErrorBox.classList.add("hidden");
  }

  // confirm pass
  if (cpass === "") {
    ok = false;
    cpassErrorBox.innerText = "Confirm Password is required";
    cpassErrorBox.classList.remove("hidden");
  } else if (pass !== cpass) {
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
