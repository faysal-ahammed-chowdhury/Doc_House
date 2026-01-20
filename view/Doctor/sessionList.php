<?php 
require_once "../../middleware/authMiddleware.php";
require_once "../../middleware/doctorMiddleware.php";
require_once "../../controller/Doctor/sessionDetailsController.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session Details</title>
    <link rel="stylesheet" href="assets/style.css">
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
                    <h2>Session #SES-<?php echo $session['sid']; ?></h2>
                    <p class="gray-para">Managing appointments for this specific time block.</p>
                </div>
                <div class="header-action">
                    <a href="sessionList.php?sid=<?php echo $sid; ?>&action=delete" class="btn-delete-session" onclick="return confirm('Are you sure?')">
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
                    <div class="value"><i class="fa-regular fa-calendar"></i> <?php echo date("M d, Y", strtotime($session['date'])); ?></div>
                </div>

                <div class="info-col">
                    <div class="label">TIME</div>
                    <div class="value"><i class="fa-regular fa-clock"></i> 
                        <?php echo date("h:i A", strtotime($session['start_time'])) . ' - ' . date("h:i A", strtotime($session['end_time'])); ?>
                    </div>
                </div>

                <div class="info-col">
                    <div class="label">SLOT DURATION</div>
                    <div class="value"><i class="fa-solid fa-stopwatch"></i> <?php echo $session['slot_duration']; ?> Minutes</div>
                </div>

                <div class="info-col">
                    <div class="label">BOOKED</div>
                    <div class="value"><strong><?php echo count($appointments); ?></strong> Appointments</div>
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
                        <?php if(empty($appointments)): ?>
                            <tr><td colspan="4" style="text-align:center;">No appointments booked yet.</td></tr>
                        <?php else: ?>
                            <?php foreach ($appointments as $apt): 
                                $initials = strtoupper(substr($apt['patient_name'], 0, 1)); 
                            ?>
                            <tr>
                                <td style="font-weight: 700; color: #333;"><?php echo date("h:i A", strtotime($apt['time'])); ?></td>
                                <td class="name-col">
                                    <div class="initials-avatar blue"><?php echo $initials; ?></div>
                                    <div class="p-name"><?php echo $apt['patient_name']; ?></div>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var buttons = document.querySelectorAll(".ajax-status-btn");
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].addEventListener("click", function(e) {
                e.preventDefault(); 
                
                var clickedBtn = this;
                var url = clickedBtn.getAttribute("href");

                updateStatus(url, clickedBtn);
            });
        }
    });

    function updateStatus(url, btnElement) {
        const xhr = new XMLHttpRequest();
        xhr.onload = function() {
            if (this.status === 200) {
                updateInterface(btnElement, url);
            } else {
                console.error("Server Error: " + this.status);
            }
        };
        xhr.open('GET', url, true);
        xhr.send();
    }

    function updateInterface(btnElement, url) {
        var row = btnElement.closest("tr");
        var statusCell = row.querySelector(".status");
        var actionCell = row.querySelector(".actions");

        if (url.indexOf("status=accepted") !== -1) {
            statusCell.textContent = "Accepted";
            statusCell.className = "status accepted";
        } else {
            statusCell.textContent = "Rejected";
            statusCell.className = "status rejected";
        }
        actionCell.innerHTML = "";
    }
</script>


</body>
</html>