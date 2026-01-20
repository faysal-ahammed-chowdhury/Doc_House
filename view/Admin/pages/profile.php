<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "C:\\xampp\htdocs\Doc_House\middleware\authMiddleware.php";
require_once "C:\\xampp\htdocs\Doc_House\middleware\adminMiddleware.php";
require_once "../../../controller/Admin/profileController.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Profile</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/profile.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <?php
    $cur_page = "";
    include_once "header.php";
    ?>
    <hr>
    <section class="page-header">
        <div class="container">
            <h2>My Profile</h2>
            <p>Manage your personal information and security settings.</p>
        </div>
    </section>
    <hr>


    <section class="profile-section">
        <div class="container">
            <div class="profile-card-and-info">

                <form action="/Doc_House/controller/Admin/profilePicUploadController.php"
                    class="profile-card" method="POST" enctype="multipart/form-data">
                    <div
                        <?php echo (isset($_SESSION['picErr']) && !empty($_SESSION['picErr'])) ? 'style="display: block;"' : 'style="display: none;"'; ?>
                        class="error-box">
                        <span class="error-text"><?php echo $_SESSION['picErr'] ?></span>
                        <?php unset($_SESSION['picErr']); ?>
                    </div>
                    <div
                        <?php echo (isset($_SESSION['picSuccess']) && !empty($_SESSION['picSuccess'])) ? 'style="display: block;"' : 'style="display: none;"'; ?>
                        class="success-box">
                        <span class="success-text"><?php echo $_SESSION['picSuccess'] ?></span>
                        <?php unset($_SESSION['picSuccess']); ?>
                    </div>
                    <div class="avatar">
                        <?php echo !empty($curUser['img']) ?
                            "<img src=\"$curUser[img]\" alt=\"Patient\">" : $curUser['name'][0] ?>
                    </div>
                    <div class="name"><?php echo $curUser['name'] ?></div>
                    <p style="margin-top: 7px;">User ID: #UID-<?php echo $curUser['uid'] ?></p>
                    <div class="thin-line"></div>
                    <div class="profile-pic-box">
                        <input type="file" name="profile_pic" id="profile-pic">
                        <input class="btn" type="submit" value="Update Profile Picture">
                    </div>
                </form>
                <div class="info">
                    <div
                        <?php echo (isset($_SESSION['updateProfileErr']) && !empty($_SESSION['updateProfileErr'])) ? 'style="display: block;"' : 'style="display: none;"'; ?>
                        class="error-box">
                        <span class="error-text"><?php echo $_SESSION['updateProfileErr'] ?></span>
                        <?php unset($_SESSION['updateProfileErr']); ?>
                    </div>
                    <div
                        <?php echo (isset($_SESSION['updateProfileSuccess']) && !empty($_SESSION['updateProfileSuccess'])) ? 'style="display: block;"' : 'style="display: none;"'; ?>
                        class="success-box">
                        <span class="success-text"><?php echo $_SESSION['updateProfileSuccess'] ?></span>
                        <?php unset($_SESSION['updateProfileSuccess']); ?>
                    </div>

                    <div id="displayMode">
                        <div class="field two-field">
                            <div class="first"><strong>Name:</strong> <?php echo $curUser['name'] ?></div>
                            <div class="second"><strong>Email:</strong> <?php echo $curUser['email'] ?></div>
                        </div>
                        <div class="field two-field">
                            <div class="first"><strong>Phone:</strong> <?php echo $curUser['phone'] ?></div>
                            <div class="second"><strong>Date of Birth:</strong> <?php echo $curUser['dob'] ?></div>
                        </div>
                        <button onclick="showEditMode()" class="submit-btn" id="editProfileBtn" type="button">Edit Profile</button>
                    </div>

                    <form id="editMode" class="hidden" onsubmit="return handleUpdateProfile(this)" action="../../../controller/Admin/updateProfileController.php" method="POST" novalidate>
                        <div class="field two-field">
                            <div class="first">
                                <label for="fullname">Name</label>
                                <input type="text" id="fullname" name="fullname" value="<?php echo $curUser['name'] ?>">
                                <p class="error hidden" id="nameErrBox">Name is required</p>
                            </div>
                            <div class="second">
                                <label for="email">Email</label>
                                <input type="text" id="email" name="email" value="<?php echo $curUser['email'] ?>" readonly>
                            </div>
                        </div>
                        <div class="field two-field">
                            <div class="first">
                                <label for="phone">Phone</label>
                                <input type="text" id="phone" name="phone" value="<?php echo $curUser['phone'] ?>">
                                <p class="error hidden" id="phoneErrBox">Name is required</p>
                            </div>
                            <div class="second">
                                <label for="dob">Date of Birth</label>
                                <input type="date" id="dob" name="dob" value="<?php echo $curUser['dob'] ?>">
                                <p class="error hidden" id="dobErrBox">DOB is required</p>
                            </div>
                        </div>

                        <div class="field two-field">
                            <div class="first">
                                <label for="password">New Password <span class="highlight">(Leave blank to keep current password)</span></label>
                                <input type="password" id="password" name="password">
                                <p class="error hidden" id="passErrBox">Password is required</p>
                            </div>
                            <div class="second">
                                <label for="cpassword">Confirm Password</label>
                                <input type="password" id="cpassword" name="cpassword">
                                <p class="error hidden" id="cpassErrBox">Confirm password is required</p>
                            </div>
                        </div>

                        <div class="field btns">
                            <button onclick="showDisplayMode()" class="btn-reset" id="cancelEditBtn">Cancel</button>
                            <input class="submit-btn" type="submit" value="Update Profile">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="../assets/js/profile.js"></script>
</body>

</html>