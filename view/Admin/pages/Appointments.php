<?php
    require_once "C:\\xampp\htdocs\Doc_House\controller\Admin\DoctorController.php";
    require_once "C:\\xampp\htdocs\Doc_House\controller\Admin\AppointmentController.php";
    require_once 'C:\\xampp\htdocs\Doc_House\model\Admin\AppointmentModel.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/appointments.css">
    <!-- <link rel="stylesheet" href="../assets/css/appointments.css"> -->

    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.css"
    rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body data-open-modal="<?php echo isset($_SESSION['openModal']) ? 'true' : 'false'; ?>">
    <?php unset($_SESSION['openModal']); ?>
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
            <section >
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
                                <form id="appointmentForm" action="../../../controller/Admin/AppointmentController.php" method="POST">
                                    
                                    <!-- ✅ hidden input to store selected patient PID -->
                                    <input type="hidden" name="patient_id" id="patient_id">

                                    <div class="modal-box">
                                        <div class="form-container">                                   
                                            <!-- Section 1 -->
                                            <div class="form-section">
                                                <h3><i class="ri-lock-fill"></i> 1. Select Patient</h3>
                                                <hr>
                                                <div class="appointment_input">
                                                    <div class="field">
                                                        <label>Patient Name</label>
                                                        <div class="input-wrapper">
                                                            <i class="ri-fingerprint-2-fill"></i>
                                                            <input 
                                                                id="patient_name" 
                                                                name="patient_name" 
                                                                type="text" 
                                                                value="<?php
                                                                    echo (isset($_SESSION['patientNameApp']) && !empty($_SESSION['patientNameApp'])) 
                                                                        ? $_SESSION['patientNameApp'] 
                                                                        : '';
                                                                    unset($_SESSION['patientNameApp']);
                                                                ?>" 
                                                                placeholder="Search By Patient Name.." 
                                                                autocomplete="off"
                                                            >

                                                            <!-- AJAX results -->
                                                            <div id="patientResults" class="search-results"></div>

                                                            <span class="error-message">
                                                                <?php
                                                                if (isset($_SESSION['patientNameErrorApp'])) {
                                                                    echo $_SESSION['patientNameErrorApp'];
                                                                    unset($_SESSION['patientNameErrorApp']);
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Section 2 -->
                                            <div class="form-section">
                                                <h3><i class="ri-profile-line"></i> 2. Doctor & Availability (DID)</h3>
                                                <hr>

                                                <div class="appointment_input">
                                                    
                                                    <div class="field">
                                                        <?php
                                                            $dataDoc = allDoctors();
                                                        ?>
                                                        <label>Doctor Name</label>
                                                        <div class="input-wrapper">
                                                            <i class="ri-user-line"></i>
                                                           <select id="doc_name" name="doc_name">
                                                                <option value="">Select by Doctor Name</option>
                                                                <?php foreach($dataDoc as $doctor): 
                                                                   $selected = (isset($_SESSION['userIdApp']) && $_SESSION['userIdApp'] == $doctor['uid']) ? 'selected' : '';
                                                                ?>
                                                                <option value="<?= $doctor['uid'] ?>" <?= $selected ?>
                                                                    <?php echo (isset($_SESSION['docNameApp']) && $_SESSION['docNameApp'] == $selected) ? 'selected' : ''; ?>    
                                                                >
                                                                    <?= htmlspecialchars($doctor['name']) ?> (<?= htmlspecialchars($doctor['specialization']) ?>)
                                                                </option>
                                                                <?php endforeach; ?>
                                                            </select>

                                                            <?php
                                                                if (isset($_SESSION['userIdApp'])) {
                                                                    echo "Selected Doctor UID: " . $_SESSION['userIdApp'];
                                                                }
                                                            ?>
                                                            <?php unset($_SESSION['docNameApp']); ?>

                                                            <span class="error-message">
                                                                <?php
                                                                if (isset($_SESSION['docNameErrorApp'])) {
                                                                    echo $_SESSION['docNameErrorApp'];
                                                                    unset($_SESSION['docNameErrorApp']);
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="field">
                                                        <label>Available Session</label>
                                                        <div class="input-wrapper">
                                                            <i class="ri-calendar-todo-line"></i>
                                                            <select id="doc_total_time" name="doc_total_time">
                                                                <option value="">Select Available Session</option>
                                                                <option value="Jan"
                                                                    <?php echo (isset($_SESSION['docTotalTimeApp']) && $_SESSION['docTotalTimeApp'] == 'Jan') ? 'selected' : ''; ?>>
                                                                    Jan
                                                                </option>
                                                            </select>
                                                            <?php unset($_SESSION['docTotalTimeApp']); ?>

                                                            <span class="error-message">
                                                                <?php
                                                                if (isset($_SESSION['docTotalTimeErrorApp'])) {
                                                                    echo $_SESSION['docTotalTimeErrorApp'];
                                                                    unset($_SESSION['docTotalTimeErrorApp']);
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="field">
                                                        <label>Available Slot</label>
                                                        <div class="input-wrapper">
                                                            <i class="ri-time-line"></i>
                                                            <select id="doc_available_slot" name="doc_available_slot">
                                                                <option value="" disable>Select Your Slot</option>
                                                                <option value="10.30AM-11.00AM"
                                                                    <?php echo (isset($_SESSION['docAvailableSlotApp']) && $_SESSION['docAvailableSlotApp'] == '10.30AM-11.00AM') ? 'selected' : ''; ?>>
                                                                    10.30AM-11.00AM
                                                                </option>
                                                            </select>
                                                            <?php unset($_SESSION['docAvailableSlotApp']); ?>

                                                            <span class="error-message">
                                                                <?php
                                                                if (isset($_SESSION['docAvailableSlotErrorApp'])) {
                                                                    echo $_SESSION['docAvailableSlotErrorApp'];
                                                                    unset($_SESSION['docAvailableSlotErrorApp']);
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="field">
                                                        <label>Appointment Status</label>
                                                        <div class="input-wrapper">
                                                            <i class="ri-information-2-fill"></i>
                                                            <select id="status" name="status">
                                                                <option value="Accepted"
                                                                    <?php echo (isset($_SESSION['statusApp']) && $_SESSION['statusApp'] == 'Accepted') ? 'selected' : ''; ?>>
                                                                    Accepted
                                                                </option>
                                                                <option value="Panding"
                                                                    <?php echo (isset($_SESSION['statusApp']) && $_SESSION['statusApp'] == 'Panding') ? 'selected' : ''; ?>>
                                                                    Panding
                                                                </option>
                                                                <option value="Rejected"
                                                                    <?php echo (isset($_SESSION['statusApp']) && $_SESSION['statusApp'] == 'Rejected') ? 'selected' : ''; ?>>
                                                                    Rejected
                                                                </option>
                                                            </select>
                                                            <?php unset($_SESSION['statusApp']); ?>

                                                            <span class="error-message">
                                                                <?php
                                                                if (isset($_SESSION['statusErrorApp'])) {
                                                                    echo $_SESSION['statusErrorApp'];
                                                                    unset($_SESSION['statusErrorApp']);
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div id="modal_btn_container">
                                            <div class="modal-action">
                                                <button type="button" class="close-btn">
                                                    <i class="ri-close-large-line"></i> Close
                                                </button>
                                            </div>
                                            <button type="submit" class="reg_button">
                                                <i class="ri-calendar-event-line"></i> Confirm Booking
                                            </button>
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
            </section>


            <section id="search_appointment" class="section">
                <form class="filter-bar" id="doctorFilterBar">

                    <!-- Search Doctor -->
                    <div class="filter-group">
                        <label for="searchDoctor">Patient Search</label>
                        <input
                        type="text"
                        id="pName"
                        class="filter-input"
                        name="pName"
                        placeholder="Patient name"
                        />
                    </div>
                    <div class="filter-group">
                        <label for="searchDoctor">Doctor Search</label>
                        <input
                        type="text"
                        id="dName"
                        class="filter-input"
                        name="dName"
                        placeholder="Doctor name"
                        />
                    </div>

                    <!-- Specialization -->
                    <div class="filter-group">
                        <label for="doctorSpecialization">Status</label>
                        <div class="input-wrapper">
                        <i class="ri-stethoscope-line"></i>
                        <select
                            id="appointmentStatus"
                            class="filter-select"
                            name="appointmentStatus"
                        >
                            <option value="">All Status</option>
                            <option value="Accept">Accept</option>
                            <option value="Panding">Panding</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                        </div>
                    </div>

                    <div class="filter-group">
                        <label for="searchDoctor">Date</label>
                        <input
                        type="date"
                        id="date"
                        class="filter-input"
                        name="date"
                        placeholder="Search by name or email"
                        />
                    </div>

                    <!-- Action Buttons -->
                    <div class="filter-actions">
                        <button
                        type="submit"
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

                </form>
            </section>


            <section id="table_section" class="section">
                <h1>Recent Appointments</h1>
                <?php
                    $appointments = getAppointmentsData();
                ?>
                <table>
                    <tr>
                        <th>PATIENT</th>
                        <th>DOCTOR</th>
                        <th>SCHEDULE</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>

                    <?php foreach ($appointments as $apt): ?>
                        <tr>
                            <td>
                                <div>
                                    <div>
                                        <h4><?= substr($apt['patient_name'], 0, 2) ?></h4>
                                    </div>
                                    <div>
                                        <h4><?= htmlspecialchars($apt['patient_name']) ?></h4>
                                        <p>PID-<?= $apt['patient_id'] ?></p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <h4><?= htmlspecialchars($apt['doctor_name']) ?></h4>
                                    <p>DID-<?= $apt['doctor_id'] ?></p>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <h4><?= date("M d, Y", strtotime($apt['session_date'])) ?></h4>
                                    <p><?= date("h:i A", strtotime($apt['appointment_time'])) ?> (SIS-<?= $apt['session_id'] ?>)</p>
                                </div>
                            </td>
                            <td>
                                <p><?= ucfirst($apt['appointment_status']) ?></p>
                            </td>
                            <td>
                                <button id="edit_btn" data-aptid="<?= $apt['aptid'] ?>"><i class="ri-edit-2-fill"></i></button>
                                <button id="delete_btn" data-aptid="<?= $apt['aptid'] ?>"><i class="ri-delete-bin-6-fill"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>

            </section>
        </main>

    <script src="../assets/js/appointments_modal.js"></script>
    <script src="../assets/js/patient_search_ajax.js"></script>
    <script src="../assets/js/appointments_ajax.js"></script>
</body>
</html>