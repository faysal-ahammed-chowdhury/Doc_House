<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="box">
        <div class="left">
            <div class="content">
                <img src="../images/logo.png" alt="Logo" class="logo">
                <p class="gray-para">
                    Your health journey starts here. Connect with top specialists and manage your appointments with ease.
                </p>
            </div>
        </div>
        <div class="right">
            <form action="">
                <h2 class="heading">Create Account</h2>
                <p class="light-para">
                    Enter your details to register as a new patient.
                </p>
                <div class="field">
                    <label for="name">Name <span class="red-star">*</span></label>
                    <input type="text" id="name" name="name">
                </div>
                <div class="field two-field">
                    <div class="first">
                        <label for="email">Email <span class="red-star">*</span></label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="second">
                        <label for="phone">Phone <span class="red-star">*</span></label>
                        <input type="text" id="phone" name="phone">
                    </div>
                </div>
                <div class="field two-field">
                    <div class="first">
                        <label for="password">Password <span class="red-star">*</span></label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div class="second">
                        <label for="cpassword">Confirm Password <span class="red-star">*</span></label>
                        <input type="password" id="cpassword" name="cpassword">
                    </div>
                </div>
                <div class="field two-field">
                    <div class="first">
                        <label for="dob">Date of Birth <span class="red-star">*</span></label>
                        <input type="date" id="dob" name="dob">
                    </div>
                    <div class="second">
                        <label for="gender">Gender <span class="red-star">*</span></label>
                        <select name="gender" id="gender">
                            <option value="null">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <input class="submit-btn" type="submit" value="Register">
                </div>
                <div class="other">
                    <p>Already have an account? <a href="">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>