<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <?php 
        $page = 'profile'; 
        include 'header.php'; 
    ?>

    <section class="page-header">
        <div class="container">
            <h2>My Profile</h2>
            <p class="gray-para">Manage your professional details and account settings.</p>
        </div>
    </section>

    <section class="profile-section">
        <div class="container">
            <div class="profile-grid">
                
                <div class="profile-card">
                    <div class="profile-avatar-large">SJ</div>
                    <h3>Dr. Sarah Jenkins</h3>
                    <p class="specialty">CARDIOLOGIST</p>
                    <button class="btn-change-photo">
                        <i class="fa-solid fa-camera"></i> Change Photo
                    </button>
                </div>

                <div class="profile-details-container">
                    <form action="" method="POST" class="profile-form-card">
                        
                        <h4 class="form-section-title"><i class="fa-solid fa-user"></i> Personal Information</h4>
                        
                        <div class="two-field">
                            <div class="field">
                                <label>Full Name</label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-regular fa-user"></i>
                                    <input type="text" name="name" value="Dr. Sarah Jenkins">
                                </div>
                            </div>
                            <div class="field">
                                <label>Email Address</label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-regular fa-envelope"></i>
                                    <input type="email" name="email" value="sarah.jenkins@hospital.com" readonly style="background-color: #f9f9f9;">
                                </div>
                            </div>
                        </div>

                        <div class="two-field">
                            <div class="field">
                                <label>Phone Number</label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-solid fa-phone"></i>
                                    <input type="text" name="phone" value="+1 555 012 3456">
                                </div>
                            </div>
                            <div class="field">
                                <label>Specialization (Contact Admin to change)</label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-solid fa-stethoscope"></i>
                                    <select name="specialization" disabled style="background-color: #f9f9f9;">
                                        <option value="Cardiologist" selected>Cardiologist</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <h4 class="form-section-title"><i class="fa-solid fa-briefcase"></i> Professional Details</h4>
                        
                        <div class="field">
                            <label>Consultation Fee ($)</label>
                            <div class="input-icon-wrapper">
                                <i class="fa-solid fa-dollar-sign"></i>
                                <input type="number" name="fee" value="150">
                            </div>
                        </div>

                        <div class="field">
                            <label>Biography</label>
                            <textarea name="bio" rows="4" class="bio-textarea">Dr. Sarah Jenkins is a board-certified Cardiologist with over 10 years of experience in treating complex heart conditions. She is dedicated to patient-centered care and the latest medical advancements.</textarea>
                        </div>

                        <h4 class="form-section-title"><i class="fa-solid fa-lock"></i> Security</h4>
                        
                        <div class="two-field">
                            <div class="field">
                                <label>New Password</label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-solid fa-key"></i>
                                    <input type="password" name="new_password" placeholder="Leave blank to keep current">
                                </div>
                            </div>
                            <div class="field">
                                <label>Confirm Password</label>
                                <div class="input-icon-wrapper">
                                    <i class="fa-solid fa-key"></i>
                                    <input type="password" name="confirm_password" placeholder="Confirm new password">
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn-cancel">Cancel</button>
                            <button type="submit" class="btn-save">Save Changes</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </section>

</body>
</html>