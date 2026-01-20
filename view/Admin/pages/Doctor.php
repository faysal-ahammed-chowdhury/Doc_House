<?php
    require_once "../../../middleware/authMiddleware.php";
    require_once "../../../middleware/adminMiddleware.php";
    require_once "C:\\xampp\htdocs\Doc_House\controller\Admin\SpecializationController.php";
    require_once "C:\\xampp\htdocs\Doc_House\controller\Admin\DoctorController.php";
    require_once 'C:\\xampp\htdocs\Doc_House\model\Admin\SpecializationModel.php';
    include 'C:\xampp\htdocs\Doc_House\view\Admin\pages\Toster.php';


    $dataSpec = getSpecialization();

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor</title>
    <link rel="stylesheet" href="../assets/css/doctor.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/toster.css">

    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.css"
    rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body data-open-modal="<?php echo ($_SESSION['openModal'] ?? false) ? 'true' : 'false'; ?>">
<?php unset($_SESSION['openModal']); ?>
    

    <?php 
        $curPage = "doctors";
        include_once "header.php" 
    ?>

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
                            <div>
                                <p class="error-message">
                                    <?php
                                        if(isset($_SESSION['requestError']))
                                        {
                                            echo $_SESSION['requestError'];
                                            unset($_SESSION['requestError']);
                                        }
                                    ?>
                                </p>
                            </div>
                            <form id="doctorForm" action="../../../controller/Admin/DoctorController.php" method="POST">
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
                                                        <input id="doc_email" name="doc_email" type="text" value="<?php
                                                            echo (isset($_SESSION['email']) && !empty($_SESSION['email'])) ? $_SESSION['email'] : "";
                                                            unset($_SESSION['email']);
                                                        ?>" placeholder="doctor@example.com">
                                                        <span class="error-message">
                                                            <?php
                                                            if (isset($_SESSION['emailError'])) {
                                                                echo $_SESSION['emailError'];
                                                                unset($_SESSION['emailError']); // clear after showing
                                                            }
                                                            ?>
                                                        </span>

                                                    </div>
                                                </div>

                                                <div class="field">
                                                    <label for="doc_pass">Temporary Password</label>
                                                    <div class="input-wrapper">
                                                        <i class="ri-key-line"></i>
                                                        <input id="doc_pass" name="doc_pass" type="text" value="<?php
                                                            echo (isset($_SESSION['pass']) && !empty($_SESSION['pass'])) ? $_SESSION['pass'] : "";
                                                            unset($_SESSION['pass']);
                                                        ?>" placeholder="Create a strong password">
                                                        <span class="error-message">
                                                            <?php
                                                            if (isset($_SESSION['passError'])) {
                                                                echo $_SESSION['passError'];
                                                                unset($_SESSION['passError']);
                                                            }
                                                            ?>
                                                        </span>
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
                                                        <input id="doc_name" name="doc_name" type="text" value="<?php
                                                            echo (isset($_SESSION['name']) && !empty($_SESSION['name'])) ? $_SESSION['name'] : "";
                                                            unset($_SESSION['name']);
                                                        ?>" placeholder="e.g. Dr. Sarah Jenkins">
                                                        <span class="error-message">
                                                            <?php
                                                            if (isset($_SESSION['nameError'])) {
                                                                echo $_SESSION['nameError'];
                                                                unset($_SESSION['nameError']);
                                                            }
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="field">
                                                    <label for="doc_specialization">Specialization</label>
                                                    <div class="input-wrapper">
                                                        
                                                        <i class="ri-stethoscope-line"></i>
                                                            
                                                            <?php echo (isset($_SESSION['specialization']) && $_SESSION['specialization'] == 'Neurologist') ? 'selected' : ''; 
                                                            
                                                            ?>
                                                            <?php echo (isset($_SESSION['specialization']) && $_SESSION['specialization'] == 'Cardiologist') ? 'selected' : ''; 
                                                            
                                                            ?>

                                                        <select id="doc_specialization" name="doc_specialization">
                                                            <option value="">Select specialization</option>

                                                            <?php foreach ($dataSpec as $d): ?>
                                                                <option value="<?php echo htmlspecialchars($d['name']); ?>"
                                                                    <?php 

                                                                        echo (isset($_SESSION['specialization']) && $_SESSION['specialization'] == $d['name']) ? 'selected' : ''; 
                                                                    ?>
                                                                >
                                                                    <?php echo htmlspecialchars($d['name']); ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>

                                                        <?php unset($_SESSION['specialization']);?>
                                                        <span class="error-message">
                                                            <?php
                                                            if (isset($_SESSION['specialError'])) {
                                                                echo $_SESSION['specialError'];
                                                                unset($_SESSION['specialError']);
                                                            }
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="field">
                                                    <label for="doc_fee">Consultation Fee ($)</label>
                                                    <div class="input-wrapper">
                                                        <i class="ri-money-dollar-circle-line"></i>
                                                        <input id="doc_fee" name="doc_fee" type="text" value="<?php
                                                            echo (isset($_SESSION['fee']) && !empty($_SESSION['fee'])) ? $_SESSION['fee'] : "";
                                                            unset($_SESSION['fee']);
                                                        ?>"
                                                        placeholder="e.g. 150">
                                                        <span class="error-message">
                                                            <?php
                                                            if (isset($_SESSION['feeError'])) {
                                                                echo $_SESSION['feeError'];
                                                                unset($_SESSION['feeError']);
                                                            }
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="field">
                                                    <label for="doc_phone">Phone Number</label>
                                                    <div class="input-wrapper">
                                                        <i class="ri-phone-line"></i>
                                                        <input id="doc_phone" name="doc_phone" type="text" value="<?php
                                                            echo (isset($_SESSION['phone']) && !empty($_SESSION['phone'])) ? $_SESSION['phone'] : "";
                                                            unset($_SESSION['phone']);
                                                        ?>"
                                                        
                                                        placeholder="+1234 567 890">
                                                        <span class="error-message">
                                                            <?php
                                                            if (isset($_SESSION['phoneError'])) {
                                                                echo $_SESSION['phoneError'];
                                                                unset($_SESSION['phoneError']);
                                                            }
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="field full-width">
                                                <label for="doc_bio">Doctor Biography</label>
                                                <textarea id="doc_bio" name="doc_bio"
                                                    placeholder="Enter professional background, experience, and education details..."><?php
                                                        if (isset($_SESSION['bio'])) {
                                                            echo htmlspecialchars($_SESSION['bio']);
                                                            unset($_SESSION['bio']);
                                                        }
                                                    ?>
                                                </textarea>

                                                <span class="error-message">
                                                    <?php
                                                    if (isset($_SESSION['bioError'])) {
                                                        echo $_SESSION['bioError'];
                                                        unset($_SESSION['bioError']);
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div id="modal_btn_container">
                                        <div class="modal-action">
                                            <button type="button" class="close-btn"><i class="ri-close-large-line"></i> Close</button>
                                        </div>
                                        <input type="submit" value="Register Doctor" class="reg_button">
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
            <!-- <form action="../../../controller/Admin/DoctorController.php" method="POST"> -->
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
                            <select id="doctorSpecialization" class="filter-select">
                                <option value="">All Specializations</option>
                                <?php foreach ($dataSpec as $spec): ?>
                                    <option value="<?= htmlspecialchars($spec['name']) ?>">
                                        <?= htmlspecialchars($spec['name']) ?>
                                    </option>
                                <?php endforeach; ?>
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
            <!-- </form> -->
            

        </section>

       <p>
            <?php
                if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                }
            ?>
        </p>


        <section id="table_section" class="section">
            <?php
                $dataDoc = allDoctors();
                // var_dump($dataDoc);
            ?>
            <table>
                <thead>
                    <tr>
                        <th>DOCTOR</th>
                        <th>EMAIL</th>
                        <th>SPECIALIZATION</th>
                        <th>PHONE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataDoc as $doctor): ?>
                        <tr>
                            <td>Dr. <?= htmlspecialchars($doctor['name']) ?></td>
                            <td><?= htmlspecialchars($doctor['email']) ?></td>
                            <td><?= htmlspecialchars($doctor['specialization']) ?></td>
                            <td><?= htmlspecialchars($doctor['phone']) ?></td>
                            <td>
                                <button class="edit-btn" 
                                        data-uid="<?= $doctor['uid'] ?>" 
                                        data-email="<?= htmlspecialchars($doctor['email']) ?>">
                                    <i class="ri-edit-2-fill"></i>
                                </button>
                                <button class="delete_btn" data-uid="<?= $doctor['uid'] ?>"><i class="ri-delete-bin-6-fill"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


            <div class="modal-delete" id="deleteModal">
                <div class="modal-box-delete">
                    <h3>Confirm Delete</h3>
                    <p>Are you sure you want to delete this appointment?</p>

                    <div class="modal-action-delete">
                    <button type="button" id="cancelDelete">Cancel</button>
                    <button type="button" id="confirmDelete" class="danger">
                        Yes, Delete
                    </button>
                    </div>
                </div>
            </div>

            <div class="modal-update" id="modalUpdate">
                <form id="doctorFormUpdate" action="/Doc_House/controller/Admin/DoctorController.php" method="POST">
                    <div class="modal-box-update">

                        

                        <div class="form-container-update">

                            <!-- Section 1 -->
                            <div class="form-section-update">
                                <h3><i class="ri-lock-fill"></i> 1. Account Credentials</h3>
                                <hr>

                                <div class="doctor-input-update">
                                    <input type="hidden" name="doctor_email" id="doctor_email_hidden">
                                    <input type="hidden" name="doctor_uid" id="doctor_uid_hidden">
                                    <div class="field-update">
                                        <label for="doc_email_update">Email Address (Login ID)</label>
                                        <div class="input-wrapper-update">
                                            <i class="ri-mail-line"></i>
                                            <input
                                                id="doc_email_update"
                                                name="doc_email"
                                                type="text"
                                                value="<?= $_SESSION['email'] ?? '' ?>"
                                                placeholder="doctor@example.com"
                                            >
                                            <span class="error-message-update">
                                                <?= $_SESSION['emailError'] ?? '' ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="field-update">
                                        <label for="doc_pass_update">Temporary Password</label>
                                        <div class="input-wrapper-update">
                                            <i class="ri-key-line"></i>
                                            <input
                                                id="doc_pass_update"
                                                name="doc_pass"
                                                type="text"
                                                value="<?= $_SESSION['pass'] ?? '' ?>"
                                                placeholder="Create a strong password"
                                            >
                                            <span class="error-message-update">
                                                <?= $_SESSION['passError'] ?? '' ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Section 2 -->
                            <div class="form-section-update">
                                <h3><i class="ri-profile-line"></i> 2. Professional Identity</h3>
                                <hr>

                                <div class="doctor-input-update">
                                    <div class="field-update">
                                        <label for="doc_name_update">Full Name</label>
                                        <div class="input-wrapper-update">
                                            <i class="ri-user-line"></i>
                                            <input
                                                id="doc_name_update"
                                                name="doc_name"
                                                type="text"
                                                value="<?= $_SESSION['name'] ?? '' ?>"
                                                placeholder="e.g. Dr. Sarah Jenkins"
                                            >
                                            <span class="error-message-update">
                                                <?= $_SESSION['nameError'] ?? '' ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="field-update">
                                        <label for="doc_specialization_update">Specialization</label>
                                        <div class="input-wrapper-update">
                                            <i class="ri-stethoscope-line"></i>

                                            <select
                                                id="doc_specialization_update"
                                                name="doc_specialization"
                                            >
                                                <option value="">Select specialization</option>
                                                <?php foreach (getSpecialization() as $d): ?>
                                                    <option
                                                        value="<?= htmlspecialchars($d['name']) ?>"
                                                        <?= (($_SESSION['specialization'] ?? '') === $d['name']) ? 'selected' : '' ?>
                                                    >
                                                        <?= htmlspecialchars($d['name']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>

                                            <span class="error-message-update">
                                                <?= $_SESSION['specialError'] ?? '' ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="field-update">
                                        <label for="doc_fee_update">Consultation Fee ($)</label>
                                        <div class="input-wrapper-update">
                                            <i class="ri-money-dollar-circle-line"></i>
                                            <input
                                                id="doc_fee_update"
                                                name="doc_fee"
                                                type="text"
                                                value="<?= $_SESSION['fee'] ?? '' ?>"
                                                placeholder="e.g. 150"
                                            >
                                            <span class="error-message-update">
                                                <?= $_SESSION['feeError'] ?? '' ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="field-update">
                                        <label for="doc_phone_update">Phone Number</label>
                                        <div class="input-wrapper-update">
                                            <i class="ri-phone-line"></i>
                                            <input
                                                id="doc_phone_update"
                                                name="doc_phone"
                                                type="text"
                                                value="<?= $_SESSION['phone'] ?? '' ?>"
                                                placeholder="+1234 567 890"
                                            >
                                            <span class="error-message-update">
                                                <?= $_SESSION['phoneError'] ?? '' ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="field-update full-width-update">
                                    <label for="doc_bio_update">Doctor Biography</label>
                                    <textarea
                                        id="doc_bio_update"
                                        name="doc_bio"
                                        placeholder="Enter professional background, experience, and education details..."
                                    ><?= $_SESSION['bio'] ?? '' ?></textarea>

                                    <span class="error-message-update">
                                        <?= $_SESSION['bioError'] ?? '' ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div id="modal_btn_container_update">
                            <div class="modal-action-update">
                                <div class="modal-action">
                                    <button type="button" class="close-update">Close</button>
                                    <button type="submit" class="updateDoctor" name="updateDoctor">Update</button>
                                </div>
                            </div>

                            <!-- <input
                                type="submit"
                                value="Update Doctor"
                                class="reg-button-update"
                            > -->
                        </div>
                    </div>
                </form>
            </div>

            <?php if(isset($_SESSION['toast'])): ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        showToast("<?= $_SESSION['toast']['message'] ?>", "<?= $_SESSION['toast']['type'] ?>");
                    });
                </script>
                <?php
                    unset($_SESSION['toast']);
                endif;
            ?>

            
        </section>


    
    </main>


    <script src="../assets/js/toster.js"></script>
    <script src="../assets/js/doctor_modal.js"></script>
    <script src="../assets/js/doctor_update.js"></script>
    <script src="../assets/js/delete_doctor.js"></script>
    <script src="../assets/js/search_doctor.js"></script>
</body>
</html>