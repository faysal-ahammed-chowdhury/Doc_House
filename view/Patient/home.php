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
        <a href="doctors.php" class="primary-btn">Find a Doctor</a>
    </section>

    <section class="specialization-section">
        <div class="container">
            <div class="header">
                <h2>Browse by Specialization</h2>
                <p class="gray-para">Select a category to view available doctors.</p>
            </div>

            <div class="all-specilization">
                <div class="card">
                    <h3><a href="">Dentist</a></h3>
                </div>
                <div class="card">
                    <h3><a href="">Dentist</a></h3>
                </div>
                <div class="card">
                    <h3><a href="">Dentist</a></h3>
                </div>
                <div class="card">
                    <h3><a href="">Dentist</a></h3>
                </div>
                <div class="card">
                    <h3><a href="">Dentist</a></h3>
                </div>
                <div class="card">
                    <h3><a href="">Dentist</a></h3>
                </div>
                <div class="card">
                    <h3><a href="">Dentist</a></h3>
                </div>
                <div class="card">
                    <h3><a href="">Dentist</a></h3>
                </div>
                <div class="card">
                    <h3><a href="">Dentist</a></h3>
                </div>
                <div class="card">
                    <h3><a href="">Dentist</a></h3>
                </div>
                <div class="card">
                    <h3><a href="">Dentist</a></h3>
                </div>
                <div class="card">
                    <h3><a href="">Dentist</a></h3>
                </div>
            </div>
        </div>
    </section>

    <?php include_once "../shared/footer.php" ?>
</body>

</html>