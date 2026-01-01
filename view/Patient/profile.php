<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Profile</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <nav>
        <div class="container">
            <div class="content">
                <a href="home.php"><img class="logo" src="../images/logo.png" alt="logo" /></a>
                <div class="links">
                    <a href="home.php" class="link">
                        <i class="fa-solid fa-house"></i> Home
                    </a>
                    <a href="doctors.php" class="link">
                        <i class="fa-solid fa-user-doctor"></i> Find a Doctor
                    </a>
                    <a href="appointments.php" class="link">
                        <i class="fa-solid fa-calendar-check"></i> My Appointments
                    </a>
                </div>
                <div class="user-profile-and-logout">
                    <div class="user">
                        <p class="hello">Hello</p>
                        <p class="name"><a href="profile.php">Faysal Chowdhury</a></p>
                    </div>
                    <div class="logout">
                        <a href="" title="Logout"><i class="fa-solid fa-right-from-bracket"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <section class="page-header">
        <div class="container">
            <h2>My Profile</h2>
            <p>Manage your personal information and security settings.</p>
        </div>
    </section>


    <section class="profile-section">
        <div class="container">
            <div class="profile-card-and-info">
                <form class="profile-card">
                    <div class="avatar">
                        <img src="../images/dummy_patient.png" alt="Patient">
                    </div>
                    <div class="name">Faysal Chowdhury</div>
                    <p>Patient ID: #PAT-1024</p>
                </form>
                <div class="info">
                    <form onsubmit="return handleUpdateProfile(this)" action="" method="POST" novalidate>
                        <div class="field two-field">
                            <div class="first">
                                <label for="fullname">Name</label>
                                <input type="text" id="fullname" name="fullname" value="Faysal Chowdhury">
                                <p class="error hidden" id="nameErrBox">Name is required</p>
                            </div>
                            <div class="second">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="name" value="faysal@gmail.com" readonly>
                            </div>
                        </div>
                        <div class="field two-field">
                            <div class="first">
                                <label for="phone">Phone</label>
                                <input type="text" id="phone" name="phone" value="01610137675">
                                <p class="error hidden" id="phoneErrBox">Name is required</p>
                            </div>
                            <div class="second">
                                <label for="dob">Date of Birth</label>
                                <input type="date" id="dob" name="dob" value="2002-11-29">
                                <p class="error hidden" id="dobErrBox">DOB is required</p>
                            </div>
                        </div>
                        <div class="field">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender">
                                <option value="">Select Gender</option>
                                <option value="male" selected>Male</option>
                                <option value="female">Female</option>
                            </select>
                            <p class="error hidden" id="genderErrBox">Gender is required</p>
                        </div>

                        <div class="field two-field">
                            <div class="first">
                                <label for="password">New Password <span class="highlight">(Leave blank to keep current password)</span></label>
                                <input type="password" id="password" name="password">
                                <p class="error hidden" id="passErrBox">Password is required</p>
                            </div>
                            <div class="second">
                                <label for="cpassword">Confirm Password</label>
                                <input type="password" id="cpassword" name="cpassword">
                                <p class="error hidden" id="cpassErrBox">Confirm password is required</p>
                            </div>
                        </div>

                        <div class="field">
                            <input class="submit-btn" type="submit" value="Update Profile">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include_once "../shared/footer.php" ?>

    <script src="js/script.js"></script>
</body>

</html>