<?php
    require_once "../../../middleware/authMiddleware.php";
    require_once "../../../middleware/adminMiddleware.php";
    require_once 'C:\\xampp\htdocs\Doc_House\model\Admin\UserModel.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients</title>
    <link rel="stylesheet" href="../assets/css/patients.css">
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
<body>
    <?php 
        $curPage = "patients";
        include_once "header.php" 
    ?>

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
                    name="email"
                    placeholder="Search by name or email"
                    />
                </div>

                <!-- Action Buttons -->
                <div class="filter-actions">
                  
                </div>

            </div>
        </section>

        <section id="table_section" class="section">
            <?php
                $patientData = getOnlyPatient();
            ?>

            <h3>Patient Directory</h3>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date of Birth</th>
                    <th>ACTION</th>
                </tr>

                <?php if (!empty($patientData)) : ?>
                    <?php foreach ($patientData as $patient) : ?>
                        <tr>
                            <td>
                                <?php echo htmlspecialchars($patient['name']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($patient['email']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($patient['phone']); ?>
                            </td>

                            <td>
                                <?php echo date("M d, Y", strtotime($patient['dob'])); ?>
                            </td>

                            <td>
                                <button class="delete_btn" data-uid="<?= $patient['uid'] ?>"><i class="ri-delete-bin-6-fill"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">
                            No patients found
                        </td>
                    </tr>
                <?php endif; ?>
            </table>

            <div class="modal-delete" id="deleteModal">
                <div class="modal-box-delete">
                    <h3>Confirm Delete</h3>
                    <p>Are you sure you want to delete this patient?</p>

                    <div class="modal-action-delete">
                    <button type="button" id="cancelDelete">Cancel</button>
                    <button type="button" id="confirmDelete" class="danger">
                        Yes, Delete
                    </button>
                    </div>
                </div>
            </div>

            <?php include 'C:\xampp\htdocs\Doc_House\view\Admin\pages\Toster.php'; ?>
        </section>

    </main>

    <script src="../assets/js/toster.js"></script>
    <script src="../assets/js/patients.js"></script>
</body>
</html>