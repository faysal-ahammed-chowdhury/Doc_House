<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session Details</title>
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <?php 
        $page = 'sessions'; 
        include 'header.php'; 
    ?>

    <section class="page-header">
        <div class="container">
            <div class="header-content">
                <div class="header-text">
                    <h2>Session #SES-102</h2>
                    <p class="gray-para">Managing appointments for this specific time block.</p>
                </div>
                <div class="header-action">
                    <a href="#" class="btn-delete-session">
                        <i class="fa-solid fa-trash-can"></i> Delete Session
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="session-info-section">
        <div class="container">
            
            <div class="session-details-card">
                
                <div class="info-col">
                    <div class="label">DATE</div>
                    <div class="value">
                        <i class="fa-regular fa-calendar"></i> Dec 30, 2025
                    </div>
                </div>

                <div class="info-col">
                    <div class="label">TIME</div>
                    <div class="value">
                        <i class="fa-regular fa-clock"></i> 09:00 AM - 12:00 PM
                    </div>
                </div>

                <div class="info-col">
                    <div class="label">SLOT DURATION</div>
                    <div class="value">
                        <i class="fa-solid fa-stopwatch"></i> 15 Minutes
                    </div>
                </div>

                <div class="info-col">
                    <div class="label">CAPACITY</div>
                    <div class="value">
                        <strong>6 / 12</strong> Booked
                    </div>
                </div>

            </div>

        </div>
    </section>

    <section class="session-details-section">
        <div class="container">
            
            <div class="list">
                <div class="list-header">
                    <h3>Appointments</h3>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Slot Time</th>
                            <th>Patient Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr>
                            <td style="font-weight: 700; color: #333;">09:00 AM</td>
                            <td class="name-col">
                                <div class="initials-avatar blue">MR</div>
                                <div class="p-name">Michael Ross</div>
                            </td>
                            <td><span class="status accepted">Accepted</span></td>
                        </tr>

                        <tr>
                            <td style="font-weight: 700; color: #333;">09:15 AM</td>
                            <td class="name-col">
                                <div class="initials-avatar blue">LJ</div>
                                <div class="p-name">Lisa Jenkins</div>
                            </td>
                            <td><span class="status pending">PENDING</span></td>
                            <td class="actions">
                                <a href="#" class="accept"><i class="fa-solid fa-check"></i></a>
                                <a href="#" class="cancel"><i class="fa-solid fa-xmark"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td style="font-weight: 700; color: #333;">10:00 AM</td>
                            <td class="name-col">
                                <div class="initials-avatar blue">MR</div>
                                <div class="p-name">Michael Ross</div>
                            </td>
                            <td><span class="status rejected">Rejected</span></td>
                            <td class="actions">
                                </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </section>

</body>
</html>