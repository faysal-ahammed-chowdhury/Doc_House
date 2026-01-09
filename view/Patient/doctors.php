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
            <div class="doctor-and-filter">
                <form action="" class="filter">
                    <h3>Filter</h3>
                    <div class="field">
                        <label for="doc_name">Name</label>
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
                    <input type="submit" value="Apply" class="filter-btn" />
                </form>
                <?php
                if (count($doctorList) == 0) {
                ?>
                    <h2 class="no-data">No Doctor Found</h2>
                <?php
                } else {
                ?>
                    <div class="doctors">
                        <?php
                        foreach ($doctorList as $singleDoc) {
                        ?>
                            <div class="doc-card">
                                <div class="info">
                                    <div class="avatar">
                                        <?php echo !empty($singleDoc['img']) ?
                                            '<img src="../images/dummy_doctor.png" alt="Doctor">'
                                            : $singleDoc['name'][0] ?>
                                    </div>
                                    <h3><?php echo $singleDoc['name'] ?></h3>
                                    <p><?php echo $singleDoc['specialization'] ?></p>
                                </div>
                                <div>
                                    <a href="doctor_profile.php?DID=<?php echo $singleDoc['DID'] ?>" class="view-profile-btn" href="">View Profile</a>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                }
                ?>
            </div>
    </section>
    <?php include_once "../shared/footer.php" ?>
</body>

</html>