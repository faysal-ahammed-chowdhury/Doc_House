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
                        <h1>20</h1>
                        <p>Total Doctors</p>
                    </div>
                </div>
                <div class="data_view">
                    <div>
                        <i id="patient_icon" class="ri-team-line"></i>
                    </div>
                    <div>
                        <h1>100</h1>
                        <p>Total Patients</p>
                    </div>
                </div>
                <div class="data_view">
                    <div>
                        <i id="appointment_icon" class="ri-calendar-event-line"></i>
                    </div>
                    <div>
                        <h1>80</h1>
                        <p>Total Appointments</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="table_section" class="section">
            <h1>Recent Appointments</h1>
            <table>
                <tr>
                    <th>APTID</th>
                    <th>PATIENT</th>
                    <th>DOCTOR</th>
                    <th>SCHEDULE</th>
                    <th>STATUS</th>
                    <!-- <th>ACTION</th> -->
                </tr>
                <tr>
                    <td>1024</td>
                    <td>
                        <div>
                            <div>
                                <h4>JD</h4>
                            </div>
                            <div>
                                <h4>John Doe</h4>
                                <p>PID-501</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <h4>Dr. Sarah Jenkins</h4>
                            <p>DID-882</p>
                        </div>
                    </td>
                    <td>
                        <div>
                            <h4>Dec 30, 2025</h4>
                            <p>10:00 AM (SIS-102)</p>
                        </div>
                    </td>
                    <td>
                        <p>Accept</p>
                    </td>
                </tr>
                <tr>
                    <td>1024</td>
                    <td>
                        <div>
                            <div>
                                <h4>JD</h4>
                            </div>
                            <div>
                                <h4>John Doe</h4>
                                <p>PID-501</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <h4>Dr. Sarah Jenkins</h4>
                            <p>DID-882</p>
                        </div>
                    </td>
                    <td>
                        <div>
                            <h4>Dec 30, 2025</h4>
                            <p>10:00 AM (SIS-102)</p>
                        </div>
                    </td>
                    <td>
                        <p>Accept</p>
                    </td>
                </tr>
            </table>
        </section>
    </main>
</body>
</html>