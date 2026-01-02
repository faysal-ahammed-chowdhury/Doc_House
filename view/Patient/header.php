<?php
$isLoggedIn = isset($_SESSION['user']) && isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'patient';
?>

<nav>
    <div class="container">
        <div class="content">
            <a href="home.php"><img class="logo" src="../images/logo.png" alt="logo" /></a>
            <div class="links">
                <a href="home.php" class="link <?php echo $cur_page == "home" ? "active" : ""; ?>">
                    <i class="fa-solid fa-house"></i> Home
                </a>
                <a href="doctors.php" class="link <?php echo $cur_page == "doctors" ? "active" : ""; ?>">
                    <i class="fa-solid fa-user-doctor"></i> Find a Doctor
                </a>
                <?php
                if ($isLoggedIn) {
                ?>
                    <a href="appointments.php" class="link <?php echo $cur_page == "appointments" ? "active" : ""; ?>">
                        <i class="fa-solid fa-calendar-check"></i> My Appointments
                    </a>
                <?php
                }
                ?>
            </div>
            <div class="user-profile-and-logout">
                <div class="user">
                    <p class="hello">Hello</p>
                    <p class="name">
                        <?php
                        if ($isLoggedIn) {
                        ?>
                            <a href="profile.php">Faysal Chowdhury</a>
                        <?php
                        } else {
                        ?>
                            <span>Anonymous User</span>
                        <?php
                        }
                        ?>
                    </p>
                </div>
                <?php
                if ($isLoggedIn) {
                ?>
                    <div class="logout">
                        <a href="../../controller/Auth/logoutController.php" title="Logout"><i class="fa-solid fa-right-from-bracket"></i></a>
                    </div>
                <?php
                } else {
                ?>
                    <div class="login">
                        <a href="../../view/Auth/login.php" title="Login"><i class="fa-solid fa-right-to-bracket"></i></a>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</nav>