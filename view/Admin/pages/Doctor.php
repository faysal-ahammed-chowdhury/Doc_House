<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor</title>
    <link rel="stylesheet" href="../assets/css/doctor.css">
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
                    <li id="menu_item_button"><a href="../pages/Doctor.php"><i class="ri-stethoscope-fill"></i>Doctor</a></li>
                    <li><a href="../pages/Patients.php"><i class="ri-team-line"></i>Patients</a></li>
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
                            <h1>Manage Doctors</h1>
                            <p>Register and update medical professionals across the platform.</p>
                        </div>
                        <button class="btn" id="openModal"><i class="ri-add-large-fill"></i> Add New Doctor</button>

                        <div class="modal" id="modal">
                            <form id="doctorForm" action="../../../controller/Admin/Doctor.php" method="POST">
                                <div class="modal-box">
                                    <div class="form-container">
                                        <!-- Section 1 -->
                                        <div class="form-section">
                                            <h3><i class="ri-lock-fill"></i> 1. Account Credentials</h3>
                                            <hr>
                                            <div class="doctor_input">
                                                <div class="field">
                                                    <label for="doc_email">Email Address (Login ID)</label>
                                                    <div class="input-wrapper">
                                                        <i class="ri-mail-line"></i>
                                                        <input id="doc_email" name="doc_email" type="email" placeholder="doctor@example.com">
                                                    </div>
                                                </div>

                                                <div class="field">
                                                    <label for="doc_pass">Temporary Password</label>
                                                    <div class="input-wrapper">
                                                        <i class="ri-key-line"></i>
                                                        <input id="doc_pass" name="doc_pass" type="password" placeholder="Create a strong password">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Section 2 -->
                                        <div class="form-section">
                                            <h3><i class="ri-profile-line"></i> 2. Professional Identity</h3>
                                            <hr>

                                            <div class="doctor_input">
                                                <div class="field">
                                                    <label for="doc_name">Full Name</label>
                                                    <div class="input-wrapper">
                                                        <i class="ri-user-line"></i>
                                                        <input id="doc_name" name="doc_name" type="text" placeholder="e.g. Dr. Sarah Jenkins">
                                                    </div>
                                                </div>

                                                <div class="field">
                                                    <label for="doc_specialization">Specialization</label>
                                                    <div class="input-wrapper">
                                                        <i class="ri-stethoscope-line"></i>
                                                        <select id="doc_specialization" name="doc_specialization" >
                                                            <option value="">Select specialization</option>
                                                            <option value="Neurologist">Neurologist</option>
                                                            <option value="Cardiologist">Cardiologist</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="field">
                                                    <label for="doc_fee">Consultation Fee ($)</label>
                                                    <div class="input-wrapper">
                                                        <i class="ri-money-dollar-circle-line"></i>
                                                        <input id="doc_fee" name="doc_fee" type="number" placeholder="e.g. 150">
                                                    </div>
                                                </div>

                                                <div class="field">
                                                    <label for="doc_phone">Phone Number</label>
                                                    <div class="input-wrapper">
                                                        <i class="ri-phone-line"></i>
                                                        <input id="doc_phone" name="doc_phone" type="tel" placeholder="+1234 567 890">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="field full-width">
                                                <label for="doc_bio">Doctor Biography</label>
                                                <textarea id="doc_bio" name="doc_bio" placeholder="Enter professional background, experience, and education details..."></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div id="modal_btn_container">
                                        <div class="modal-action">
                                            <button type="button" class="close-btn"><i class="ri-close-large-line"></i> Close</button>
                                        </div>
                                        <button type="submit" class="reg_button"><i class="ri-user-add-fill"></i> Register Doctor</button>
                                    </div>
                                </div>
                            </form>

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
                <label for="searchDoctor">Search Doctor</label>
                <input
                type="text"
                id="searchDoctor"
                class="filter-input"
                placeholder="Search by name or email"
                />
            </div>

            <!-- Specialization -->
            <div class="filter-group">
                <label for="doctorSpecialization">Specialization</label>
                <div class="input-wrapper">
                <i class="ri-stethoscope-line"></i>
                <select
                    id="doctorSpecialization"
                    class="filter-select"
                >
                    <option value="">All Specializations</option>
                    <option value="neurologist">Neurologist</option>
                    <option value="cardiologist">Cardiologist</option>
                </select>
                </div>
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
        <table>
            <tr>
                <th>DOCTOR</th>
                <th>EMAIL</th>
                <th>SPECIALIZATION</th>
                <th>PHONE</th>
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
                    Cardiologist
                </td>
                <td>
                    +8801223598745
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