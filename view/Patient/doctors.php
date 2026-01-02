<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Doctors</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <?php
    $cur_page = "doctors";
    include_once "header.php";
    ?>

    <section class="page-header">
        <div class="container">
            <h2>Find a Doctor</h2>
            <p>Search by name or specialization to book an appointment.</p>
        </div>
    </section>

    <section class="doctor-and-filter-section">
        <div class="container">
            <div class="doctor-and-filter">
                <form action="" class="filter">
                    <h3>Filter</h3>
                    <div class="field">
                        <label for="doc_name">Name</label>
                        <input type="text" id="doc_name" name="doc_name" />
                    </div>
                    <div class="field">
                        <label for="doc_specialization">Specialization</label>
                        <select id="doc_specialization" name="doc_specialization">
                            <option value="1">Dentist</option>
                            <option value="2">Neurologist</option>
                        </select>
                    </div>
                    <input type="submit" value="Apply" class="filter-btn" />
                </form>
                <div class="doctors">
                    <div class="doc-card">
                        <div class="info">
                            <div class="avatar">
                                <img src="../images/dummy_doctor.png" alt="Doctor">
                            </div>
                            <h3>Forman Ahammed Chowdhury</h3>
                            <p>Dentist</p>
                        </div>
                        <div>
                            <a href="doctor_profile.php" class="view-profile-btn" href="">View Profile / Book Appointment</a>
                        </div>
                    </div>
                    <div class="doc-card">
                        <div class="info">
                            <div class="avatar">
                                <img src="../images/dummy_doctor_2.png" alt="Doctor">
                            </div>
                            <h3>Farzana Akter</h3>
                            <p>Neurologist</p>
                        </div>
                        <div>
                            <a href="doctor_profile.php" class="view-profile-btn" href="">View Profile / Book Appointment</a>
                        </div>
                    </div>
                    <div class="doc-card">
                        <div class="info">
                            <div class="avatar">FC</div>
                            <h3>Faysal Chowdhury</h3>
                            <p>Dentist</p>
                        </div>
                        <div>
                            <a class="view-profile-btn" href="">View Profile / Book Appointment</a>
                        </div>
                    </div>
                    <div class="doc-card">
                        <div class="info">
                            <div class="avatar">FC</div>
                            <h3>Faysal Chowdhury</h3>
                            <p>Dentist</p>
                        </div>
                        <div>
                            <a class="view-profile-btn" href="">View Profile / Book Appointment</a>
                        </div>
                    </div>
                    <div class="doc-card">
                        <div class="info">
                            <div class="avatar">FC</div>
                            <h3>Faysal Chowdhury</h3>
                            <p>Dentist</p>
                        </div>
                        <div>
                            <a class="view-profile-btn" href="">View Profile / Book Appointment</a>
                        </div>
                    </div>
                    <div class="doc-card">
                        <div class="info">
                            <div class="avatar">FC</div>
                            <h3>Faysal Chowdhury</h3>
                            <p>Dentist</p>
                        </div>
                        <div>
                            <a class="view-profile-btn" href="">View Profile / Book Appointment</a>
                        </div>
                    </div>
                    <div class="doc-card">
                        <div class="info">
                            <div class="avatar">FC</div>
                            <h3>Faysal Chowdhury</h3>
                            <p>Dentist</p>
                        </div>
                        <div>
                            <a class="view-profile-btn" href="">View Profile / Book Appointment</a>
                        </div>
                    </div>
                    <div class="doc-card">
                        <div class="info">
                            <div class="avatar">FC</div>
                            <h3>Faysal Chowdhury</h3>
                            <p>Dentist</p>
                        </div>
                        <div>
                            <a class="view-profile-btn" href="">View Profile / Book Appointment</a>
                        </div>
                    </div>
                    <div class="doc-card">
                        <div class="info">
                            <div class="avatar">FC</div>
                            <h3>Faysal Chowdhury</h3>
                            <p>Dentist</p>
                        </div>
                        <div>
                            <a class="view-profile-btn" href="">View Profile / Book Appointment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include_once "../shared/footer.php" ?>
</body>

</html>