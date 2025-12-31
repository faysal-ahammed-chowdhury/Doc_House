<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Profile</title>
    <link rel="stylesheet" href="style.css" />
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
                <div class="profile-card">
                    <div class="avatar">
                        <img src="../images/dummy_patient.png" alt="Patient">
                    </div>
                    <div class="name">Faysal Chowdhury</div>
                    <p>Patient ID: #PAT-1024</p>
                </div>
                <div class="info">
                    <form action="">
                        <div class="field two-field">
                            <div class="first">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" value="Faysal Chowdhury">
                            </div>
                            <div class="second">
                                <label for="email">Email:</label>
                                <input type="text" id="email" name="name" value="faysal@gmail.com" readonly>
                            </div>
                        </div>
                        <div class="field two-field">
                            <div class="first">
                                <label for="phone">Phone:</label>
                                <input type="text" id="phone" name="phone" value="01610137675">
                            </div>
                            <div class="second">
                                <label for="dob">Date of Birth:</label>
                                <input type="date" id="dob" name="dob" value="2002-29-11">
                            </div>
                        </div>
                        <div class="field">
                            <label for="gender">Gender:</label>
                            <select name="gender" id="gender">
                                <option value="null">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <div class="field two-field">
                            <div class="first">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password">
                            </div>
                            <div class="second">
                                <label for="cpassword">Confirm Password:</label>
                                <input type="password" id="cpassword" name="cpassword">
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
</body>

</html>