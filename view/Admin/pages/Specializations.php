<?php
    include_once "C:\\xampp\htdocs\Doc_House\controller\Admin\SpecializationController.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Specializations</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/specialization.css">
    <link rel="stylesheet" href="../assets/css/toster.css">


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
                    <li><a href="../pages/Appointments.php"><i class="ri-calendar-event-line"></i>Appointments</a></li>
                    <li id="menu_item_button"><a href="../pages/Specializations.php"><i class="ri-brain-2-line"></i>Specializations</a></li>
                    <li><a href="../pages/Admin.php"><i class="ri-admin-fill"></i>Admin</a></li>
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
                            <h1>Manage Specializations</h1>
                            <p>Register and update medical professionals across the platform.</p>
                        </div>
                    </div>
                    <div>
                    </div>
                </div>
                <hr>
            </div>
        </seection>



        <section id="add_specialization" class="section">
            <form class="filter-bar" id="specializationForm" action="../../../controller/Admin/SpecializationController.php" method="post" enctype="multipart/form-data">

                <div class="filter-group">
                    <label for="specialization">New Specialization Name</label>
                    <input
                        type="text"
                        id="specialization"
                        name="specialization"
                        class="filter-input"
                        value="<?php
                            echo (isset($_SESSION['specialization']) && !empty($_SESSION['specialization'])) ? $_SESSION['specialization'] : "";
                            unset($_SESSION['specialization']);
                        ?>"
                        placeholder="e.g. Neurologist, Dentist..."
                    />
                    <span class="error-message">
                        <?php
                        if (isset($_SESSION['specializationError'])) {
                            echo $_SESSION['specializationError'];
                            unset($_SESSION['specializationError']);
                        }
                        ?>
                    </span>
                </div>

                <!-- Action Buttons -->
                <div class="filter-actions">
                    <button
                    type="submit"
                    class="btn btn-add"
                    id="applyDoctorFilter"
                    >
                    <i class="ri-add-large-fill"></i>
                    Add Specialization
                    </button>
                </div>

            </form>

        </section>


        <section id="table_section" class="section">
            <?php
                $allData = getSpecialization();
            ?>
            <table>
                <tr>
                    <th>Specialization Name</th>
                    <th>Associated Doctors</th>
                    <th>ACTION</th>
                </tr>

                <?php if(!empty($allData)): ?>
                    <?php foreach($allData as $spec): ?>
                        <tr>
                            <td>
                                <div>
                                    <div>
                                        <h4><i class="ri-brain-2-line"></i></h4>
                                    </div>
                                    <div>
                                        <h4><?= htmlspecialchars($spec['name']) ?></h4>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?= $spec['doctor_count'] ?> Doctors
                            </td>
                            <td>
                                <button data-spid="<?= $spec['spid'] ?>" class="edit_btn"><i class="ri-edit-2-fill"></i></button>
                                <button data-spid="<?= $spec['spid'] ?>" class="delete_btn"><i class="ri-delete-bin-6-fill"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align:center;">No Specializations Found</td>
                    </tr>
                <?php endif; ?>
            </table>

            <div class="modal-delete" id="deleteModal">
                <div class="modal-box-delete">
                    <h3>Confirm Delete</h3>
                    <p>Are you sure you want to delete this specialization?</p>
                    <div class="modal-action-delete">
                        <button type="button" id="cancelDelete">Cancel</button>
                        <button type="button" id="confirmDelete" class="danger">
                            Yes, Delete
                        </button>
                    </div>
                </div>
            </div>
            <div class="modalUpdate" id="updateModal">
                <div class="modal-box-Update">
                    <form class="modal-action-update" method="post" id="updateSpecForm">
                        <input type="hidden" id="specializationUpdateId" name="specializationUpdateId" />
                        <div class="filter-group-update">
                            <label for="specializationUpdate">Update Specialization</label>
                            <input type="text" id="specializationUpdate" name="specializationUpdate" class="filter-input-update" />
                            <span class="error-message" id="specUpdateError"></span>
                        </div>
                        <button type="button" id="cancel-btn" class="danger">Cancel</button>
                        <button type="submit" id="confirmUpdate" class="danger">Update</button>
                    </form>
                </div>
            </div>


        <?php include 'C:\xampp\htdocs\Doc_House\view\Admin\pages\Toster.php'; ?>
        </section>


    </main>

    <script src="../assets/js/toster.js"></script>
    <script src="../assets/js/add_specilizations_ajax.js"></script>
    <script src="../assets/js/delete_specialization.js"></script>
    <script src="../assets/js/update_specialization.js"></script>
</body>
</html>