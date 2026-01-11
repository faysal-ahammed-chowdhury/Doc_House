<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Dashboard</title>
    
    <link rel="stylesheet" href="style.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>

    <?php 
        $page = 'dashboard'; // This sets the active button
        include 'header.php'; // This loads the menu
    ?>

    <section class="page-header">
        <div class="container">
            <h2>Doctor Dashboard</h2>
            <p>Welcome back! Here is your daily summary and upcoming activity.</p>
        </div>
    </section>

    <section class="dashboard-stats-section">
        <div class="container">
            <div class="stats-grid">
                
                <div class="stat-card">
                    <div class="icon-box blue-bg">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="text-content">
                        <h3>124</h3>
                        <p>Total Patients</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="icon-box green-bg">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div class="text-content">
                        <h3>08</h3>
                        <p>Appointments Today</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="icon-box orange-bg">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div class="text-content">
                        <h3>03</h3>
                        <p>Pending Requests</p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="recent-appointments-section">
        <div class="container">
            <div class="list">
                <div class="list-header">
                    <h3>Upcoming Appointments</h3>
                    <a href="appointments.php" class="view-all-btn">
                        View All Appointments <i class="fa-solid fa-arrow-right"></i>
                    </a> 
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Patient Name</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Quick Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="name-col">
                                <div class="initials-avatar blue">LJ</div>
                                <div class="p-name">Lisa Jenkins</div>
                            </td>
                            <td>
                                <div class="date-text">Today, Dec 29</div>
                                <div class="time-text">10:30 AM</div>
                            </td>
                            <td><span class="status pending">PENDING</span></td>
                            <td class="actions">
                                <a href="#" class="view"><i class="fa-solid fa-eye"></i></a>
                                <a href="#" class="accept"><i class="fa-solid fa-check"></i></a>
                                <a href="#" class="cancel"><i class="fa-solid fa-xmark"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td class="name-col">
                                <div class="initials-avatar blue">MR</div>
                                <div class="p-name">Michael Ross</div>
                            </td>
                            <td>
                                <div class="date-text">Today, Dec 29</div>
                                <div class="time-text">11:30 AM</div>
                            </td>
                            <td><span class="status rejected">Rejected</span></td>
                            <td class="actions">
                                <a href="#" class="view"><i class="fa-solid fa-eye"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td class="name-col">
                                <div class="initials-avatar blue">DK</div>
                                <div class="p-name">David Kim</div>
                            </td>
                            <td>
                                <div class="date-text">Tomorrow, Dec 30</div>
                                <div class="time-text">09:00 AM</div>
                            </td>
                            <td><span class="status accepted">Accepted</span></td>
                            <td class="actions">
                                <a href="#" class="view"><i class="fa-solid fa-eye"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>


</body>
</html>