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
	<title>Profile - Dr. Mehedi</title>
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
			<p>Dr. Mehedi Hasan</p>
		</div>
	</section>

	<section class="doctor-info-and-book-appointment-section">
		<div class="container">
			<div class="doctor-info-and-book-appointment">
				<div class="doctor-info">
					<div class="avatar">
						<?php echo !empty($doctor['img']) ?
							'<img src="../images/dummy_doctor.png" alt="Doctor">'
							: $doctor['name'][0] ?>
					</div>
					<div class="content">
						<h2 class="name"><?php echo $doctor['name'] ?></h2>
						<p class="specialization"><?php echo $doctor['specialization'] ?></p>
						<div class="contact-info">
							<p><i class="fas fa-phone"></i> <?php echo $doctor['phone'] ?></p>
							<p><i class="fas fa-envelope"></i> <?php echo $doctor['email'] ?></p>
						</div>
						<p class="fee">Consultant Fee: <span class="tk"><?php echo $doctor['fee'] ?> Taka</span></p>
						<p class="bio">
							<?php echo $doctor['bio'] ?>
						</p>
					</div>
				</div>
				<div class="book-appointment">
					<h3>Book an Appointment</h3>
					<?php
					if ($isLoggedIn) {
					?>
						<form action="">
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
	<?php include_once "../shared/footer.php" ?>

	<script src="js/script.js"></script>
</body>

</html>