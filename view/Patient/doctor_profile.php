<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
require_once "../../controller/Patient/doctorProfileController.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Profile - <?php echo $doctor['name'] ?></title>
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
			<h2>Doctor Profile</h2>
			<p><?php echo $doctor['name'] ?></p>
		</div>
	</section>

	<section class="doctor-info-and-book-appointment-section">
		<div class="container">
			<div class="doctor-info-and-book-appointment">
				<div class="doctor-info">
					<div class="doctor-hero">
						<div class="avatar">
							<?php echo !empty($doctor['img']) ?
								"<img src=\"$doctor[img]\" alt=\"Doctor\">" : $doctor['name'][0] ?>
						</div>
						<div class="name-card">
							<h2><?php echo $doctor['name'] ?></h2>
							<span class="spec-pill"><?php echo $doctor['specialization'] ?></span>
						</div>
					</div>

					<div class="detail-section">
						<h4 class="detail-title">Professional Contact</h4>
						<div class="contact-grid">
							<div class="contact-box">
								<i class="fas fa-phone"></i>
								<label>Phone</label>
								<span><?php echo $doctor['phone'] ?></span>
							</div>
							<div class="contact-box">
								<i class="fas fa-envelope"></i>
								<label>Email</label>
								<span><?php echo $doctor['email'] ?></span>
							</div>
						</div>


						<h4 class="detail-title">About the Specialist</h4>
						<p class="bio-text">
							<?php echo $doctor['bio'] ?>
						</p>
					</div>
				</div>
				<div class="book-appointment">
					<h3>Book an Appointment</h3>
					<?php
					if ($isLoggedIn) {
					?>
						<form onsubmit="return bookAppointment(this)" action="" method="POST">
							<div class="field">
								<label for="session">Select Available Session </label>
								<select onchange="loadAvailableSlots(this)" name="session" id="session">
									<option value="">Select a Session</option>
									<?php
									foreach ($allSessions as $singleSessions) {
									?>
										<option value="<?php echo $singleSessions["sid"] ?>">
											<?php echo sessionTime($singleSessions) ?>
										</option>
									<?php
									}
									?>
								</select>
							</div>
							<div class="field">
								<label for="slot">Select available Slot </label>
								<select name="slot" id="slot">
									<option value="">Select a Slot</option>
								</select>
							</div>
							<div class="thin-line"></div>
							<div class="fee-box">
								<h4>Consultation Fee</h4>
								<h3><?php echo $doctor['fee'] ?> BDT</h3>
							</div>
							<input
								class="primary-btn submit-btn"
								type="submit"
								value="Book an Appointment" />
						</form>
					<?php
					} else {
					?>
						<a class="login-for-appointment" href="../Auth/login.php">Login to Book Appointment</a>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</section>
	<?php include_once "footer.php" ?>
	<?php include_once "toast.php" ?>

	<script src="js/script.js"></script>
</body>

</html>