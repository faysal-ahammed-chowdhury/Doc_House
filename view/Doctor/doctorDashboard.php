<?php 
session_start();
require_once "../../middleware/authMiddleware.php";
require_once "../../middleware/doctorMiddleware.php";
require_once "../../controller/Doctor/dashboardController.php";
?>

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
        $page = 'dashboard'; 
        include_once 'header.php'; 
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
                        <h3><?php echo $stats['total_patients']; ?></h3>
                        <p>Total Patients</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="icon-box green-bg">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div class="text-content">
                        <h3><?php echo $stats['today_appointments']; ?></h3>
                        <p>Appointments Today</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="icon-box orange-bg">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div class="text-content">
                        <h3 id="pending-count"><?php echo $stats['pending_requests']; ?></h3>
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
                        <?php if(empty($recentAppointments)): ?>
                            <tr><td colspan="4" style="text-align:center;">No upcoming appointments.</td></tr>
                        <?php else: ?>
                            <?php foreach ($recentAppointments as $apt): 
                                $initials = strtoupper(substr($apt['patient_name'], 0, 1)); 
                                
                                $dateStr = date("M d", strtotime($apt['date']));
                                $isToday = ($apt['date'] == date('Y-m-d')) ? 'Today' : 'Tomorrow';
                                if($apt['date'] > date('Y-m-d', strtotime('+1 day'))) {
                                    $isToday = date("l", strtotime($apt['date'])); 
                                }
                            ?>
                            <tr>
                                <td class="name-col">
                                    <div class="initials-avatar blue"><?php echo $initials; ?></div>
                                    <div class="p-name"><?php echo $apt['patient_name']; ?></div>
                                </td>
                                <td>
                                    <div class="date-text"><?php echo $isToday . ', ' . $dateStr; ?></div>
                                    <div class="time-text"><?php echo date("h:i A", strtotime($apt['time'])); ?></div>
                                </td>
                                <td>
                                    <span class="status <?php echo strtolower($apt['status']); ?>">
                                        <?php echo ucfirst($apt['status']); ?>
                                    </span>
                                </td>
                                <td class="actions">
                                    <?php if ($apt['status'] == 'pending'): ?>
                                        <a href="../../controller/Doctor/updateStatus.php?id=<?php echo $apt['aptid']; ?>&status=accepted" class="accept ajax-status-btn">
                                            <i class="fa-solid fa-check"></i>
                                        </a>
                                        <a href="../../controller/Doctor/updateStatus.php?id=<?php echo $apt['aptid']; ?>&status=rejected" class="cancel ajax-status-btn">
                                            <i class="fa-solid fa-xmark"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>



</body>
</html>