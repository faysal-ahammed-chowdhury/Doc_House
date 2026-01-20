<?php
    require_once "C:\\xampp\htdocs\Doc_House\controller\Admin\DoctorController.php";
    require_once "C:\\xampp\htdocs\Doc_House\controller\Admin\AppointmentController.php";
    require_once 'C:\\xampp\htdocs\Doc_House\model\Admin\PatientModel.php';
    require_once 'C:\\xampp\htdocs\Doc_House\model\Admin\UserModel.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../Admin/assets/css/dashboard.css">
    <link rel="stylesheet" href="./assets/css/header.css">


    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.css"
    rel="stylesheet"
    />
</head>
<body>
    <header>
        <nav>
            <div id="logo">
                <a href="Dashboard.php">
                    <img src="../images/logo.png" alt="">
                </a>
            </div>
            <div id="menu">
                <ul>
                    <li id="menu_item_button"><a href="Dashboard.php"><i class="ri-home-3-line"></i>Dashboard</a></li>
                    <li><a href="./pages/Doctor.php"><i class="ri-stethoscope-fill"></i>Doctor</a></li>
                    <li><a href="./pages/Patients.php"><i class="ri-team-line"></i>Patients</a></li>
                    <li><a href="./pages/Appointments.php"><i class="ri-calendar-event-line"></i>Appointments</a></li>
                    <li><a href="./pages/Specializations.php"><i class="ri-brain-2-line"></i>Specializations</a></li>
                </ul>
            </div>
            <div id="profile">
                <div>
                    <p>Administrator</p>
                    <h4>MD Mehedi Hasan</h4>
                </div>
                <div>
                    <i id="logout_icon" class="ri-logout-box-r-line"></i>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <seection >
            <div id="top_section">
                <hr>
            <div id="title">
                <h1>Admin Dashbord</h1>
                <p>Overview of active doctors, registered patients, and scheduled appointments.</p>
            </div>
            <hr>
            </div>
        </seection>
        <section class="section">
            <div class="data_container">
                <div class="data_view">
                    <div>
                        <i id="doc_icon" class="ri-stethoscope-fill"></i>
                    </div>
                    <div>
                        <?php
                            $totalDoctor = allDoctors();
                        ?>
                        <h1><?php echo count($totalDoctor) ?></h1>
                        <p>Total Doctors</p>
                    </div>
                </div>
                <div class="data_view">
                    <div>
                        <i id="patient_icon" class="ri-team-line"></i>
                    </div>
                    <div>
                        <?php
                            $totalPatient = getAllPatient();
                        ?>
                        <h1><?php echo count($totalPatient) ?></h1>
                        <p>Total Patients</p>
                    </div>
                </div>
                <div class="data_view">
                    <div>
                        <i id="appointment_icon" class="ri-calendar-event-line"></i>
                    </div>
                    <div>
                        <?php
                            $totalAppointment = getAppointmentsData();
                        ?>
                        <h1><?php echo count($totalAppointment) ?></h1>
                        <p>Total Appointments</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="table_section" class="section">
            <?php
                $userData = getAllUser();
            ?>

            <h1>Recent User</h1>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                </tr>

                <?php if (!empty($userData)) : ?>
                    <?php foreach ($userData as $user) : ?>
                        <tr>
                            <td>
                                <div>
                                    <h4><?php echo htmlspecialchars($user['name']); ?></h4>
                                </div>
                            </td>

                            <td>
                                <div>
                                    <p><?php echo htmlspecialchars($user['email']); ?></p>
                                </div>
                            </td>

                            <td>
                                <div>
                                    <p><?php echo htmlspecialchars($user['phone']); ?></p>
                                </div>
                            </td>

                            <td>
                                <p><?php echo ucfirst(htmlspecialchars($user['role'])); ?></p>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" style="text-align:center;">
                            No users found
                        </td>
                    </tr>
                <?php endif; ?>
            </table>
        </section>
    </main>
</body>
</html>