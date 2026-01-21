<?php
    session_start();
    require_once "C:\\xampp\htdocs\Doc_House\middleware\authMiddleware.php";
    require_once "C:\\xampp\htdocs\Doc_House\middleware\adminMiddleware.php";
    require_once 'C:\\xampp\htdocs\Doc_House\model\Admin\AdminModel.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/css/toster.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.7.0/fonts/remixicon.css"
    rel="stylesheet"
    />
</head>
<body>
        <?php 
            $curPage = "admins";
            include_once "header.php" 
        ?>

        <main>

            

            <seection >
                <div id="top_section">
                    <hr>
                    <div id="title_container">
                        <div id="title">
                            <div>
                                <h1>Manage Admin</h1>
                                <p>Register and update administration professionals across the platform.</p>
                            </div>
                            <button class="btn" id="openModal"><i class="ri-add-large-fill"></i> Add New Admin</button>

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
                                <form id="adminForm" action="../../../controller/Admin/AdminController.php" method="POST">
                                    <div class="modal-box">
                                        <div class="form-container">
                                            <!-- Section 1 -->
                                            <div class="form-section">
                                                <h3><i class="ri-lock-fill"></i> 1. Account Credentials</h3>
                                                <hr>
                                                <div class="admin_input">
                                                    <div class="field">
                                                        <label for="admin_email">Email Address (Login ID)</label>
                                                        <div class="input-wrapper">
                                                            <i class="ri-mail-line"></i>
                                                            <input id="admin_email" name="admin_email" type="text" value="<?php
                                                                echo (isset($_SESSION['email']) && !empty($_SESSION['email'])) ? $_SESSION['email'] : "";
                                                                unset($_SESSION['email']);
                                                            ?>" placeholder="admin@example.com">
                                                            <span class="error-message">
                                                                <?php
                                                                if (isset($_SESSION['emailError'])) {
                                                                    echo $_SESSION['emailError'];
                                                                    unset($_SESSION['emailError']); 
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="field">
                                                        <label for="admin_pass">Temporary Password</label>
                                                        <div class="input-wrapper">
                                                            <i class="ri-key-line"></i>
                                                            <input id="admin_pass" name="admin_pass" type="password" value="<?php
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

                                            <div class="form-section">
                                                <div class="admin_input">
                                                    <div class="field">
                                                        <label for="admin_name">Full Name</label>
                                                        <div class="input-wrapper">
                                                            <i class="ri-user-line"></i>
                                                            <input id="admin_name" name="admin_name" type="text" value="<?php
                                                                echo (isset($_SESSION['name']) && !empty($_SESSION['name'])) ? $_SESSION['name'] : "";
                                                                unset($_SESSION['name']);
                                                            ?>" placeholder="e.g. John Doe">
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
                                                        <label for="admin_phone">Phone Number</label>
                                                        <div class="input-wrapper">
                                                            <i class="ri-phone-line"></i>
                                                            <input id="admin_phone" name="admin_phone" type="text" value="<?php
                                                                echo (isset($_SESSION['phone']) && !empty($_SESSION['phone'])) ? $_SESSION['phone'] : "";
                                                                unset($_SESSION['phone']);
                                                            ?>" placeholder="+1234 567 890">
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
                                            </div>
                                            <div class="form-section">
                                                <div class="admin_input">
                                                    <div class="field">
                                                        <label for="admin_dob">Date Of Birth</label>
                                                        <div class="input-wrapper">
                                                            <i class="ri-user-line"></i>
                                                            <input id="admin_dob" name="admin_dob" type="date" value="<?php
                                                                echo (isset($_SESSION['dob']) && !empty($_SESSION['dob'])) ? $_SESSION['dob'] : "";
                                                                unset($_SESSION['dob']);
                                                            ?>" placeholder="e.g. 01-01-2000">
                                                            <span class="error-message">
                                                                <?php
                                                                if (isset($_SESSION['dobError'])) {
                                                                    echo $_SESSION['dobError'];
                                                                    unset($_SESSION['dobError']);
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
                                                <button type="button" class="close-btn"><i class="ri-close-large-line"></i> Close</button>
                                            </div>
                                            <input type="submit" value="Register Admin" class="reg_button">
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

            <section id="search_Admin" class="section">
                <div class="filter-bar" id="AdminFilterBar">
                    <!-- Search Admin -->
                    <div class="filter-group">
                        <label for="searchAdmin">Search Admin</label>
                        <input
                        type="text"
                        id="searchAdmin"
                        class="filter-input"
                        name="search"
                        placeholder="Search by name or email"
                        />
                    </div>

                    <!-- Action Buttons -->
                    <div class="filter-actions">
                        <button        
                        type="submit"          
                        class=" btn-filter"
                        id="applyAdminFilter"
                        >
                        <i class="ri-search-line"></i>
                        Filter
                        </button>
                    </div>

                </div>
            </section>

            <section id="table_section" class="section">
                <?php
                    $adminData = getOnlyAdmin();
                ?>

                <h3>Admin Directory</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date of Birth</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>

                    <tbody id="adminTableBody">
                        <?php if (!empty($adminData)) : ?>
                            <?php foreach ($adminData as $admin) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($admin['name']) ?></td>
                                    <td><?= htmlspecialchars($admin['email']) ?></td>
                                    <td><?= htmlspecialchars($admin['phone']) ?></td>
                                    <td><?= date("M d, Y", strtotime($admin['dob'])) ?></td>
                                    <td>
                                        <button class="edit_btn" data-uid="<?= $admin['uid'] ?>">
                                            <i class="ri-edit-2-fill"></i>
                                        </button>
                                        <button class="delete_btn" data-uid="<?= $admin['uid'] ?>">
                                            <i class="ri-delete-bin-6-fill"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" style="text-align:center;">No admin found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>


                <div class="modal-delete" id="deleteModal">
                    <div class="modal-box-delete">
                        <h3>Confirm Delete</h3>
                        <p>Are you sure you want to delete this admin?</p>

                        <div class="modal-action-delete">
                        <button type="button" id="cancelDelete">Cancel</button>
                        <button type="button" id="confirmDelete" class="danger">
                            Yes, Delete
                        </button>
                        </div>
                    </div>
                </div>


                <div class="modal-update" id="modalUpdate">
                    <form id="adminUpdateForm" method="POST">
                        <input type="hidden" id="admin_uid_u" name="uid">
                        <input type="hidden" id="h_admin_email_u" name="admin_email" readonly>

                        <div class="modal-box-update">
                            <h3><i class="ri-edit-line"></i> Update Admin</h3>
                            <hr>

                            <div class="field-update">
                                <label>Email</label>
                                
                                 <p id="admin_email_u"></p>
                            </div>

                            <div class="field-update">
                                <label>Full Name</label>
                                <input type="text" id="admin_name_u" name="admin_name">
                            </div>

                            <div class="field-update">
                                <label>Phone</label>
                                <input type="text" id="admin_phone_u" name="admin_phone">
                            </div>

                            <div class="field-update">
                                <label>Date of Birth</label>
                                <input type="date" id="admin_dob_u" name="admin_dob">
                            </div>

                            <div class="modal-actions-update">
                                <button type="button" class="close-update-btn">Cancel</button>
                                <button type="submit" class="update_button">Update Admin</button>
                            </div>
                        </div>
                    </form>
                </div>




                <?php include 'C:\xampp\htdocs\Doc_House\view\Admin\pages\Toster.php'; ?>
            </section>


        </main>

    <script src="../assets/js/toster.js"></script>
    <script src="../assets/js/admin.js"></script>
    <script src="../assets/js/search_admin.js"></script>
</body>
</html>