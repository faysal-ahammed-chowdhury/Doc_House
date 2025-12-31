<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/appointments.css">

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
                        <li><a href="../pages/Patients.php"><i class="ri-team-line"></i>Patients</a></li>
                        <li id="menu_item_button"><a href="../pages/Appointments.php"><i class="ri-calendar-event-line"></i>Appointments</a></li>
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
                                <h1>Manage Doctors</h1>
                                <p>Register and update medical professionals across the platform.</p>
                            </div>
                            <button class="btn" id="openModal"><i class="ri-add-large-fill"></i> Create Appointment</button>

                            <div class="modal" id="modal">
                                <div class="modal-box">
                                    <div class="form-container">                                   
                                        <!-- Section 1 -->
                                        <div class="form-section">
                                            <h3><i class="ri-lock-fill"></i> 1. Select Patient (PID)</h3>
                                            <hr>
                                            <div class="doctor_input">
                                                <div class="field">
                                                    <label>Patient ID (PID)</label>
                                                    <div class="input-wrapper">
                                                    <i class="ri-fingerprint-2-fill"></i>
                                                    <input type="text" placeholder="doctor@example.com">
                                                    </div>
                                                </div>

                                                <!-- <div class="field">
                                                    <label>Temporary Password</label>
                                                    <div class="input-wrapper">
                                                    <i class="ri-key-line"></i>
                                                    <input type="text" placeholder="Create a strong password">
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>

                                        <!-- Section 2 -->
                                        <div class="form-section">
                                            <h3><i class="ri-profile-line"></i> 2. Doctor & Availability (DID)</h3>
                                            <hr>

                                            <div class="doctor_input">
                                            <div class="field">
                                                <label>Doctor ID (DID)</label>
                                                <div class="input-wrapper">
                                                <i class="ri-user-line"></i>
                                                <input type="text" placeholder="Select by DID">
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label>Available Session</label>
                                                <div class="input-wrapper">
                                                <i class="ri-calendar-todo-line"></i>
                                                <select>
                                                    <option value="" disable>Select date and & slot</option>
                                                    <option>Neurologist</option>
                                                    <option>Cardiologist</option>
                                                </select>
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label>Available Slot</label>
                                                <div class="input-wrapper">
                                                <i class="ri-time-line"></i>
                                                <input type="text" placeholder="Select date and & slot">
                                                </div>
                                            </div>

                                            <div class="field">
                                                <label>Appointment Status</label>
                                                <div class="input-wrapper">
                                                <i class="ri-information-2-fill"></i>
                                                <select>
                                                    <option>Accepted</option>
                                                    <option>Panding</option>
                                                    <option>Rejected</option>
                                                </select>
                                                </div>
                                            </div>
                                            </div>
                                        </div>

                                    </div>

                                    <hr>

                                    <div id="modal_btn_container">
                                        <div class="modal-action">
                                            <button class="close-btn"><i class="ri-close-large-line"></i> Close</button>
                                        </div>
                                        <button class="reg_button"><i class="ri-user-add-fill"></i> Register Doctor</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div>
                        </div>
                    </div>
                    <hr>
                </div>
            </seection>


            <section id="search_appointment" class="section">
                <div class="filter-bar" id="doctorFilterBar">

                    <!-- Search Doctor -->
                    <div class="filter-group">
                        <label for="searchDoctor">Patient Search</label>
                        <input
                        type="text"
                        id="searchDoctor"
                        class="filter-input"
                        placeholder="Patient name"
                        />
                    </div>
                    <div class="filter-group">
                        <label for="searchDoctor">Doctor Search</label>
                        <input
                        type="text"
                        id="searchDoctor"
                        class="filter-input"
                        placeholder="Doctor name"
                        />
                    </div>

                    <!-- Specialization -->
                    <div class="filter-group">
                        <label for="doctorSpecialization">Status</label>
                        <div class="input-wrapper">
                        <i class="ri-stethoscope-line"></i>
                        <select
                            id="doctorSpecialization"
                            class="filter-select"
                        >
                            <option value="">All Status</option>
                            <option value="neurologist">Accept</option>
                            <option value="cardiologist">Panding</option>
                            <option value="cardiologist">Rejected</option>
                        </select>
                        </div>
                    </div>

                    <div class="filter-group">
                        <label for="searchDoctor">Date</label>
                        <input
                        type="date"
                        id="searchDoctor"
                        class="filter-input"
                        placeholder="Search by name or email"
                        />
                    </div>

                    <!-- Action Buttons -->
                    <div class="filter-actions">
                        <button
                        type="button"
                        class="btn btn-filter"
                        id="applyDoctorFilter"
                        >
                        <i class="ri-filter-fill"></i>
                        Filter
                        </button>

                        <button
                        type="button"
                        class="btn btn-reset"
                        id="resetDoctorFilter"
                        >
                        Reset
                        </button>
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
                        <th>ACTION</th>
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
                        <td>
                            <button id="edit_btn"><i class="ri-edit-2-fill"></i></button>
                            <button id="delete_btn"><i class="ri-delete-bin-6-fill"></i></button>
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
                        <td>
                            <button id="edit_btn"><i class="ri-edit-2-fill"></i></button>
                            <button id="delete_btn"><i class="ri-delete-bin-6-fill"></i></button>
                        </td>
                    </tr>
                </table>
            </section>
        </main>

    <script src="../assets/js/doctor_modal.js"></script>
</body>
</html>