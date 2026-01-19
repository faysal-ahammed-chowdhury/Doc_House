<?php
require_once "../../middleware/authMiddleware.php";
require_once "../../middleware/doctorMiddleware.php";
require_once "../../controller/Doctor/appointmentController.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>All Appointments</title>
    <link rel="stylesheet" href="assets/style.css">
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
                        <input type="date" name="date" value="<?php echo $filterDate; ?>">
                    </div>
                    <div class="field">
                        <label>Status</label>
                        <select name="status">
                            <option value="" <?php if ($filterStatus == "")echo "selected"; ?>>
                                All Status
                            </option>
                            <option value="pending" <?php if ($filterStatus == "pending")echo "selected"; ?>>
                                Pending
                            </option>
                            <option value="accepted" <?php if ($filterStatus == "accepted")echo "selected"; ?>>
                                Accepted
                            </option>
                            <option value="rejected" <?php if ($filterStatus == "rejected")echo "selected"; ?>>
                                Rejected
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn-filter">
                        <i class="fa-solid fa-filter"></i> 
                        Filter
                    </button>
                    <a href="appointments.php" class="btn-reset">Reset</a>
                </form>
            </div>

            <div class="list">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient Name</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($appointmentList) == 0) {
                            ?>
                            <tr>
                                <td colspan="5" style="text-align:center; padding: 20px;">
                                    <p>No Data Found</p>
                                </td>
                            </tr>
                            <?php
                        } else {
                            foreach ($appointmentList as $apt) {
                                $initials = substr($apt['patient_name'], 0, 1);
                                $nameParts = explode(" ", $apt['patient_name']);
                                if (count($nameParts) > 1) {
                                    $initials .= substr($nameParts[1], 0, 1);
                                }
                                $initials = strtoupper($initials);
                                ?>
                                <tr>
                                    <td style="font-weight: 600; color: #666;">#APT-<?php echo $apt['aptid']; ?></td>
                                    <td class="name-col">
                                        <div class="initials-avatar blue"><?php echo $initials; ?></div>
                                        <div class="p-name"><?php echo $apt['patient_name']; ?></div>
                                    </td>
                                    <td>
                                        <div class="date-text"><?php echo date("d-m-Y", strtotime($apt['date'])); ?></div>
                                        <div class="time-text"><?php echo date("h:i A", strtotime($apt['time'])); ?></div>
                                    </td>
                                    <td>
                                        <span class="status <?php echo strtolower($apt['status']); ?>">
                                            <?php echo ucfirst($apt['status']); ?>
                                        </span>
                                    </td>
                                    <td class="actions">
                                        <?php if ($apt['status'] == 'pending') { ?>
                                            <a href="../../controller/Doctor/updateStatus.php?id=<?php echo $apt['aptid']; ?>&status=accepted" class="accept ajax-status-btn">
                                                <i class="fa-solid fa-check"></i>
                                            </a>
                                            <a href="../../controller/Doctor/updateStatus.php?id=<?php echo $apt['aptid']; ?>&status=rejected" class="cancel ajax-status-btn">
                                                <i class="fa-solid fa-xmark"></i>
                                            </a>
                                        <?php } else { ?>
                                           
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
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