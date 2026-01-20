<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav>
    <div class="container">
        <div class="content">
            <a href="doctorDashboard.php">
                <img class="logo" src="images/logo.png" alt="logo" />
            </a>

            <div class="links">
                <a href="doctorDashboard.php" class="link <?php echo ($page == 'dashboard') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-chart-pie"></i> Dashboard
                </a>

                <a href="mySessions.php" class="link <?php echo ($page == 'sessions') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-calendar-check"></i> My Sessions
                </a>

                <a href="appointments.php" class="link <?php echo ($page == 'appointments') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-user-injured"></i> Appointments
                </a>
            </div>

            <div class="user-profile-and-logout">
                <div class="user">
                    <p class="hello">Hello,</p>
                    <p class="name">
                        <a href="doctorProfile.php">
                            <?php 
                            if (isset($_SESSION['user']['name'])) {
                                echo $_SESSION['user']['name']; 
                            } else {
                                echo "Doctor";
                            }
                            ?>
                        </a>
                    </p>
                </div>
                <div class="logout">
                    <a href="../../controller/Auth/logoutController.php" title="Logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>