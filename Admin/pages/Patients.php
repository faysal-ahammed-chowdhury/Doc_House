<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients</title>
    <link rel="stylesheet" href="../assets/css/patients.css">
    <link rel="stylesheet" href="../assets/css/header.css">

    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.css"
    rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

</head>
<body>
    <header>
        <nav>
            <div id="logo">
                <a href="../Dashboard.php">
                    <img src="../../images/logo.png" alt="">
                </a>
            </div>
            <div id="menu">
                <ul>
                    <li><a href="../Dashboard.php"><i class="ri-home-3-line"></i>Dashboard</a></li>
                    <li><a href="../pages/Doctor.php"><i class="ri-stethoscope-fill"></i>Doctor</a></li>
                    <li id="menu_item_button"><a href=""><i class="ri-team-line"></i>Patients</a></li>
                    <li><a href="../pages/Appointments.php"><i class="ri-calendar-event-line"></i>Appointments</a></li>
                    <li><a href="../pages/Specializations.php"><i class="ri-brain-2-line"></i>Specializations</a></li>
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
                <div id="title_container">
                    <div id="title">
                        <div>
                            <h1>Manage Patients</h1>
                            <p>View and manage registered patient profiles and records.</p>
                        </div>
                    </div>
                    <div>
                    </div>
                </div>
                <hr>
            </div>
        </seection>

        <section id="search_doctor" class="section">
            <div class="filter-bar" id="doctorFilterBar">
                <!-- Search Doctor -->
                <div class="filter-group">
                    <label for="searchDoctor">Search Patient</label>
                    <input
                    type="text"
                    id="searchDoctor"
                    class="filter-input"
                    placeholder="Search by name or email"
                    />
                </div>

                <!-- Specialization -->
                <div class="filter-group">
                    <label for="doctorSpecialization">Registration Date</label>
                    <div class="input-wrapper">
                        <input type="date">
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="filter-actions">
                    <button                  
                    class="btn btn-filter"
                    id="applyDoctorFilter"
                    >
                    <i class="ri-search-line"></i>
                    Filter
                    </button>
                </div>

            </div>
        </section>

        <section id="table_section" class="section">
            <h3>Patient Directory</h3>
            <table>
                <tr>
                    <th>Patient</th>
                    <th>Contact Info</th>
                    <th>Date of Birth</th>
                    <th>Joined Date</th>
                    <th>ACTION</th>
                </tr>
                <tr>
                    <td>
                        Dr. Sarah Jenkins
                    </td>
                    <td>
                        sarah@gmail.com
                    </td>
                    <td>
                        May 12, 1990
                    </td>
                    <td>
                        May 12, 1990
                    </td>
                    <td>
                        <button id="edit_btn"><i class="ri-edit-2-fill"></i></button>
                        <button id="delete_btn"><i class="ri-delete-bin-6-fill"></i></button>
                    </td>
                </tr>
            </table>
        </section>

    </main>
</body>
</html>