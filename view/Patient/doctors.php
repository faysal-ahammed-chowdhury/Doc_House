<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "../../controller/Patient/doctorController.php";
include_once "../../controller/Patient/specializationController.php";
?>

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
            <div class="filter-bar">
                <form action="" class="filter-form">
                    <div class="field">
                        <label for="doc_name">Doctor's Name:</label>
                        <input type="text" id="doc_name" name="doc_name" value="<?php echo $docName; ?>" />
                    </div>
                    <div class="field">
                        <label for="doc_specialization">Specialization</label>
                        <select id="doc_specialization" name="specialization">
                            <option value="">All</option>
                            <?php
                            foreach ($allSpecializations as $signgleSpecialization) {
                            ?>
                                <option value="<?php echo $signgleSpecialization["spid"] ?>"
                                    <?php echo ($docSpecialityID == $signgleSpecialization["spid"]) ? 'selected' : ''; ?>>
                                    <?php echo $signgleSpecialization["name"] ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn-filter">
                        <i class="fa-solid fa-filter"></i> Filter
                    </button>
                    <a href="/Doc_House/view/Patient/doctors.php" type="submit" class="btn-reset">Reset</a>
                </form>
            </div>
            <div class="doctor-list">
                <?php
                if (count($doctorList) == 0) {
                ?>
                    <h2 class="no-data">No Doctor Found</h2>
                <?php
                } else {
                ?>
                    <div class="doctors">
                        <?php foreach ($doctorList as $singleDoc) { ?>
                            <div class="doc-card">
                                <div class="card-head">
                                    <div class="avatar">
                                        <?php echo !empty($singleDoc['img']) ?
                                            "<img src=\"$singleDoc[img]\" alt=\"Doctor\">" : $singleDoc['name'][0] ?>
                                    </div>
                                    <div class="doc-meta">
                                        <h3><?php echo $singleDoc['name'] ?></h3>
                                        <span class="spec-pill"><?php echo $singleDoc['specialization'] ?></span>
                                    </div>
                                </div>

                                <div class="info-stack">
                                    <div class="stack-item">
                                        <span class="label-text">Phone</span>
                                        <span class="val-text"><?php echo $singleDoc['phone'] ?></span>
                                    </div>
                                    <div class="stack-item">
                                        <span class="label-text">Email</span>
                                        <span class="val-text"><?php echo $singleDoc['email'] ?></span>
                                    </div>
                                    <div class="stack-item fee-row">
                                        <span class="label-text">Consultant Fee</span>
                                        <span class="fee-highlight"><?php echo $singleDoc['fee'] ?> BDT</span>
                                    </div>
                                </div>

                                <a href="doctor_profile.php?DID=<?php echo $singleDoc['DID'] ?>" class="view-profile-btn">Book Appointment</a>
                            </div>
                        <?php } ?>
                    </div>
                <?php
                }
                ?>
            </div>
    </section>
    <?php include_once "../shared/footer.php" ?>
</body>

</html>