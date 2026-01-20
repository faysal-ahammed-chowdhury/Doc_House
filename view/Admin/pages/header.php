<header>
    <nav>
        <div id="logo">
            <a href="../Dashboard.php">
                <img src="../../images/logo.png" alt="">
            </a>
        </div>
        <div id="menu">
            <ul>
                <li id="<?php echo ($curPage == "dashboard") ? 'menu_item_button' : ''; ?>"><a href="../Dashboard.php"><i class="ri-home-3-line"></i>Dashboard</a></li>
                <li id="<?php echo ($curPage == "doctors") ? 'menu_item_button' : ''; ?>"><a href="Doctor.php"><i class="ri-stethoscope-fill"></i>Doctors</a></li>
                <li id="<?php echo ($curPage == "patients") ? 'menu_item_button' : ''; ?>"><a href="Patients.php"><i class="ri-team-line"></i>Patients</a></li>
                <li id="<?php echo ($curPage == "appointments") ? 'menu_item_button' : ''; ?>"><a href="Appointments.php"><i class="ri-calendar-event-line"></i>Appointments</a></li>
                <li id="<?php echo ($curPage == "specializations") ? 'menu_item_button' : ''; ?>"><a href="Specializations.php"><i class="ri-brain-2-line"></i>Specializations</a></li>
                <li id="<?php echo ($curPage == "admins") ? 'menu_item_button' : ''; ?>"><a href="Admin.php"><i class="ri-admin-fill"></i>Admins</a></li>
            </ul>
        </div>
        <div class="user-profile-and-logout">
            <div class="user">
                <p class="hello">Administrator</p>
                <p class="name">
                    <a href="profile.php"><?php echo $_SESSION['user']['name'] ?></a>
                </p>
            </div>
            <div class="logout">
                <a href="../../../controller/Auth/logoutController.php" title="Logout"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>

        </div>
    </nav>
</header>