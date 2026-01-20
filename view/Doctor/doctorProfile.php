<?php
require_once "../../controller/Doctor/doctorProfileController.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <?php
    $page = 'profile';
    include_once 'header.php';
    ?>

    <section class="page-header">
        <div class="container">
            <h2>My Profile</h2>
            <p class="gray-para">Manage your professional details and account settings.</p>
        </div>
    </section>

    <section class="profile-section">
        <div class="container">

            <?php if (!empty($message)): ?>
                <div class="alert alert-success"><?php echo $message; ?></div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <div class="profile-grid">

                <div class="profile-card">
                    <div class="profile-avatar-large" id="avatarContainer">
                        <?php if (!empty($doctorData['img'])): ?>
                            <img src="<?php echo $doctorData['img']; ?>" alt="Profile"
                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                        <?php else: ?>
                            <?php echo strtoupper(substr($doctorData['name'], 0, 1)); ?>
                        <?php endif; ?>
                    </div>
                    <h3><?php echo $doctorData['name']; ?></h3>
                    <p class="specialty"><?php echo strtoupper($doctorData['specialization']); ?></p>
                    <button type="button" class="btn-change-photo"
                        onclick="document.getElementById('photoInput').click()">
                        <i class="fa-solid fa-camera"></i> Change Photo
                    </button>
                    <?php if (!empty($doctorData['img'])): ?>
                        <form method="POST" style="margin-top: 10px;">
                            <button type="submit" name="remove_photo" class="btn-remove-photo"
                                style="background: none; border: none; color: #dc3545; cursor: pointer; font-size: 14px; text-decoration: underline;"
                                onclick="return confirm('Are you sure you want to remove your photo?');">
                                <i class="fa-solid fa-trash"></i> Remove Photo
                            </button>
                        </form>
                    <?php endif; ?>
                </div>

                <div class="profile-details-container">
                    <form action="" method="POST" enctype="multipart/form-data" class="profile-form-card">
                        <input type="file" name="profile_photo" id="photoInput" style="display: none;"
                            onchange="previewImage(this)">
                        <h4 class="form-section-title"><i class="fa-solid fa-user"></i> Personal Information</h4>

                        <div class="two-field">
                            <div class="field">
                                <label>Full Name</label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-regular fa-user"></i>
                                    <input type="text" name="name" value="<?php echo $doctorData['name']; ?>" required>
                                </div>
                            </div>
                            <div class="field">
                                <label>Email Address</label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-regular fa-envelope"></i>
                                    <input type="email" name="email" value="<?php echo $doctorData['email']; ?>"
                                        readonly style="background-color: #f9f9f9;">
                                </div>
                            </div>
                        </div>

                        <div class="two-field">
                            <div class="field">
                                <label>Phone Number</label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-solid fa-phone"></i>
                                    <input type="text" name="phone" value="<?php echo $doctorData['phone']; ?>"
                                        required>
                                </div>
                            </div>
                            <div class="field">
                                <label>Specialization</label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-solid fa-stethoscope"></i>
                                    <select name="specialization" disabled style="background-color: #f9f9f9;">
                                        <option value="<?php echo $doctorData['specialization']; ?>" selected>
                                            <?php echo $doctorData['specialization']; ?>
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <h4 class="form-section-title"><i class="fa-solid fa-briefcase"></i> Professional Details</h4>

                        <div class="field">
                            <label>Consultation Fee ($)</label>
                            <div class="input-icon-wrapper">
                                <i class="fa-solid fa-dollar-sign"></i>
                                <input type="number" name="fee" value="<?php echo $doctorData['fee']; ?>" min="0"
                                    required>
                            </div>
                        </div>

                        <div class="field">
                            <label>Biography</label>
                            <textarea name="bio" rows="5"
                                class="bio-textarea"><?php echo $doctorData['bio']; ?></textarea>
                        </div>

                        <h4 class="form-section-title"><i class="fa-solid fa-lock"></i> Security</h4>

                        <div class="two-field">
                            <div class="field">
                                <label>New Password</label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-solid fa-key"></i>
                                    <input type="password" name="new_password" id="newPass"
                                        placeholder="Leave blank to keep current" minlength="8">
                                </div>
                            </div>

                            <div class="field">
                                <label>Confirm Password</label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-solid fa-key"></i>
                                    <input type="password" name="confirm_password" id="confirmPass"
                                        placeholder="Confirm new password">
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn-cancel"
                                onclick="window.location.href='doctorDashboard.php'">Cancel</button>
                            <button type="submit" class="btn-save">Save Changes</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </section>

    <script>
        function previewImage(input) {
            var container = document.getElementById('avatarContainer');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    container.innerHTML = '<img src="' + e.target.result + '" alt="Profile Preview" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</body>
</html>