<?php
session_start();
include_once "../../controller/Patient/specializationController.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <?php
    $cur_page = "home";
    include_once "header.php";
    ?>

    <section class="hero-section">
        <h1>Your Health Is Our Top Priority</h1>
        <p class="gray-para">Book appointments with top specialists.</p>
        <a href="doctors.php" class="primary-btn"><i class="fa-solid fa-user-doctor"></i><span style="margin-left: 10px;">Find a Doctor</span></a>
    </section>

    <section class="specialization-section">
        <div class="container">
            <div class="header">
                <h2>Browse by Specialization</h2>
                <p class="gray-para">Select a category to view available doctors.</p>
            </div>


            <?php
            if (count($allSpecializations) > 0) {
            ?>
                <div class="all-specialization">
                    <?php
                    foreach ($allSpecializations as $signgleSpecialization) {
                    ?>
                        <a href="doctors.php?specialization=<?php echo $signgleSpecialization['spid'] ?>" class="specialty-card">
                            <div class="icon-box"><i class="fa-solid fa-heart-pulse"></i></div>
                            <h3><?php echo $signgleSpecialization["name"] ?></h3>
                        </a>
                    <?php
                    }
                    ?>
                </div>
            <?php
            } else {
            ?>
                <h2 style="margin-top: 20px;" class="no-data">Not Avaialable</h2>
            <?php
            }
            ?>


        </div>
    </section>

    <?php include_once "../shared/footer.php" ?>
</body>

</html>