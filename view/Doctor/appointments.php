<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Appointments</title>
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <?php 
        $page = 'appointments'; 
        include 'header.php'; 
    ?>

    <section class="page-header">
        <div class="container">
            <h2>All Appointments</h2>
            <p class="gray-para">View and filter patient history.</p>
        </div>
    </section>

    <section class="appointments-section">
        <div class="container">
            
            <div class="filter-bar">
                <form action="" method="GET" class="filter-form">
                    <div class="field">
                        <label>Date</label>
                        <input type="date" name="date">
                    </div>
                    <div class="field">
                        <label>Status</label>
                        <select name="status">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="accepted">Accepted</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-filter">
                        <i class="fa-solid fa-filter"></i> Filter
                    </button>
                    <a href="appointments.php" class="btn-reset">Reset</a>
                </form>
            </div>

            <div class="list">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th> <th>Patient Name</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <td style="font-weight: 600; color: #666;">#APT-102</td>
                            
                            <td class="name-col">
                                <div class="initials-avatar blue">MR</div>
                                <div class="p-name">Michael Ross</div>
                            </td>
                            <td>
                                <div class="date-text">Dec 28, 2025</div>
                                <div class="time-text">09:00 AM</div>
                            </td>
                            <td><span class="status accepted">Accepted</span></td>
                        </tr>

                        <tr>
                            <td style="font-weight: 600; color: #666;">#APT-099</td>

                            <td class="name-col">
                                <div class="initials-avatar blue">DK</div>
                                <div class="p-name">David Kim</div>
                            </td>
                            <td>
                                <div class="date-text">Dec 20, 2025</div>
                                <div class="time-text">02:00 PM</div>
                            </td>
                            <td><span class="status rejected">Rejected</span></td>
                        </tr>

                        <tr>
                            <td style="font-weight: 600; color: #666;">#APT-105</td>

                            <td class="name-col">
                                <div class="initials-avatar blue">LJ</div>
                                <div class="p-name">Lisa Jenkins</div>
                            </td>
                            <td>
                                <div class="date-text">Dec 30, 2025</div>
                                <div class="time-text">10:00 AM</div>
                            </td>
                            <td><span class="status pending">PENDING</span></td>
                            <td class="actions">
                                <a href="#" class="accept"><i class="fa-solid fa-check"></i></a>
                                <a href="#" class="cancel"><i class="fa-solid fa-xmark"></i></a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </section>

</body>
</html>