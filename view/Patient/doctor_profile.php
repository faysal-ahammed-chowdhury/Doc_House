<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Profile - Dr. Mehedi</title>
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<nav>
		<div class="container">
			<div class="content">
				<a href=""><img class="logo" src="../images/logo.png" alt="logo" /></a>
				<div class="links">
					<a href="" class="link">Home</a>
					<a href="" class="link active">Find a Doctor</a>
					<a href="" class="link">My Appointments</a>
				</div>
				<div class="user-profile-and-logout">
					<div class="user">
						<p class="hello">Hello</p>
						<p class="name"><a href="">Faysal Chowdhury</a></p>
					</div>
					<div class="logout">
						<a href="">Logout</a>
					</div>
				</div>
			</div>
		</div>
	</nav>

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
					<div class="avatar">MH</div>
					<div class="content">
						<h2 class="name">Dr. Mehedi Hasan</h2>
						<p class="specialization">Dentist</p>
						<p class="fee">Fee: <span class="tk">1500 Taka</span></p>
						<p class="bio">
							Dr. Sarah Jenkins is a board-certified Cardiologist dedicated to
							providing comprehensive heart care. With a focus on preventive
							cardiology, she helps patients manage risk factors such as
							hypertension and high cholesterol. She completed her residency
							at Mayo Clinic and has been practicing for over a decade. Her
							patient-centric approach ensures that every individual receives
							a personalized treatment plan.
						</p>
					</div>
				</div>
				<div class="book-appointment">
					<h3>Book an Appointment</h3>
					<form action="">
						<div class="field">
							<label for="session">Select Available Session </label><select name="session" id="session">
								<option value="sess-1">10AM-12AM, 31 Dec, 2025</option>
								<option value="sess-1">10AM-12AM, 31 Dec, 2025</option>
								<option value="sess-1">10AM-12AM, 31 Dec, 2025</option>
								<option value="sess-1">10AM-12AM, 31 Dec, 2025</option>
							</select>
						</div>
						<div class="field">
							<label for="slot">Select available Slot </label><select name="slot" id="slot">
								<option value="10:00AM">10:00AM, 31 Dec, 2025</option>
								<option value="10:30AM">10:30AM-12AM, 31 Dec, 2025</option>
							</select>
						</div>
						<input
							class="primary-btn submit-btn"
							type="button"
							value="Next" />
					</form>
				</div>
			</div>
		</div>
	</section>
</body>

</html>