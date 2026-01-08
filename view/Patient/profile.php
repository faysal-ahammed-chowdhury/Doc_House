<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../../middleware/authMiddleware.php";
require_once "../../middleware/patientMiddleware.php";
require_once "../../controller/Patient/profileController.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Profile</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <?php
    $cur_page = "";
    include_once "header.php";
    ?>

    <section class="page-header">
        <div class="container">
            <h2>My Profile</h2>
            <p>Manage your personal information and security settings.</p>
        </div>
    </section>


    <section class="profile-section">
        <div class="container">
            <div class="profile-card-and-info">
                <form class="profile-card">
                    <div class="avatar">
                        <?php echo !empty($curUser['img']) ?
                            '<img src="../images/dummy_patient.png" alt="Doctor">'
                            : $curUser['name'][0] ?>
                    </div>
                    <div class="name"><?php echo $curUser['name'] ?></div>
                    <p style="margin-top: 7px;">Patient ID: #PAT-<?php echo $curUser['pid'] ?></p>
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
                    <form onsubmit="return handleUpdateProfile(this)" action="../../controller/Patient/updateProfileController.php" method="POST" novalidate>
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
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender">
                                    <option value="">Select Gender</option>
                                    <option value="male" <?php echo ($curUser['gender'] == "male") ? "selected" : ''; ?>>Male</option>
                                    <option value="female" <?php echo ($curUser['gender'] == "female") ? "selected" : ''; ?>>Female</option>
                                </select>
                                <p class="error hidden" id="genderErrBox">Gender is required</p>
                            </div>
                            <div class="second">
                                <label for="weight">Weight (KG)</label>
                                <input type="number" id="weight" name="weight" value="<?php echo $curUser['weight'] ?>">
                                <p class="error hidden" id="weightErrBox">Weight is required</p>
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

                        <div class="field">
                            <input class="submit-btn" type="submit" value="Update Profile">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include_once "../shared/footer.php" ?>

    <script src="js/script.js"></script>
</body>

</html>