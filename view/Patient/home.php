<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <nav>
        <div class="container">
            <div class="content">
                <a href="home.php"><img class="logo" src="../images/logo.png" alt="logo" /></a>
                <div class="links">
                    <a href="home.php" class="link active">
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

    <section class="hero-section">
        <h1>Your Health Is Our Top Priority</h1>
        <p class="gray-para">Book appointments with top specialists.</p>
        <a href="doctors.php" class="primary-btn"><i class="fa-solid fa-user-doctor"></i><span style="margin-left: 10px;">Find a Doctor</span></a>
    </section>

    <section class="specialization-section">
        <div class="container">
            <div class="header">
                <h2>Browse by Specialization</h2>
                <p class="gray-para">Select a category to view available doctors.</p>
            </div>

            <div class="all-specialization">

                <a href="doctors.html?category=cardiologist" class="specialty-card">
                    <div class="icon-box"><i class="fa-solid fa-heart-pulse"></i></div>
                    <h3>Cardiologist</h3>
                </a>

                <a href="doctors.html?category=dentist" class="specialty-card">
                    <div class="icon-box"><i class="fa-solid fa-tooth"></i></div>
                    <h3>Dentist</h3>
                </a>

                <a href="doctors.html?category=neurologist" class="specialty-card">
                    <div class="icon-box"><i class="fa-solid fa-brain"></i></div>
                    <h3>Neurologist</h3>
                </a>

                <a href="doctors.html?category=orthopedic" class="specialty-card">
                    <div class="icon-box"><i class="fa-solid fa-bone"></i></div>
                    <h3>Orthopedic</h3>
                </a>

                <a href="doctors.html?category=general" class="specialty-card">
                    <div class="icon-box"><i class="fa-solid fa-user-doctor"></i></div>
                    <h3>General Physician</h3>
                </a>

                <a href="doctors.html?category=dermatologist" class="specialty-card">
                    <div class="icon-box"><i class="fa-solid fa-hand-dots"></i></div>
                    <h3>Dermatologist</h3>
                </a>

                <a href="doctors.html?category=pediatrician" class="specialty-card">
                    <div class="icon-box"><i class="fa-solid fa-baby"></i></div>
                    <h3>Pediatrician</h3>
                </a>

                <a href="doctors.html?category=eye" class="specialty-card">
                    <div class="icon-box"><i class="fa-solid fa-eye"></i></div>
                    <h3>Eye Care</h3>
                </a>

            </div>
        </div>
    </section>

    <?php include_once "../shared/footer.php" ?>
</body>

</html>