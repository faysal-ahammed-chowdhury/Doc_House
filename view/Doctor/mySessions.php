<?php
require_once "../../middleware/authMiddleware.php";
require_once "../../middleware/doctorMiddleware.php";
require_once "../../controller/Doctor/sessionController.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Sessions</title>
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
            <h2>My Sessions</h2>
            <p class="gray-para">Create availability slots and manage your schedule history.</p>
        </div>
    </section>

    <section class="sessions-section">
        <div class="container">
            <div class="sessions-grid">

                <div class="create-session-card">
                    <h3><i class="fa-solid fa-circle-plus"></i> Create Session</h3>

                    <form action="" method="POST" id="createSessionForm">
                        <input type="hidden" name="add_session" value="1">
                        <div class="field">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        <div class="two-field">
                            <div class="field">
                                <label>Start Time</label>
                                <input type="time" name="start_time" class="form-control" required>
                            </div>
                            <div class="field">
                                <label>End Time</label>
                                <input type="time" name="end_time" class="form-control" required>
                            </div>
                        </div>
                        <div class="field">
                            <label>Slot Duration (Minutes)</label>
                            <select name="duration" class="form-control">
                                <option value="30">30 Minutes</option>
                                <option value="60">60 Minutes</option>
                                <option value="90">90 Minutes</option>
                                <option value="120">120 Minutes</option>
                            </select>
                        </div>
                        <button type="submit" class="add-session-btn">Add Session</button>
                    </form>
                </div>

                <div class="session-lists-container" id="session-lists">

                    <div class="list-card">
                        <h3 class="card-title"><i class="fa-solid fa-calendar-check"></i> Upcoming Sessions</h3>
                        <?php if (empty($upcomingSessions)): ?>
                            <p style="padding: 20px; color: #777;">No upcoming sessions.</p>
                        <?php else: ?>
                            <?php foreach ($upcomingSessions as $ses): ?>
                                <div class="session-item">
                                    <div class="date-block">
                                        <span class="day"><?php echo date('d', strtotime($ses['date'])); ?></span>
                                        <span class="month"><?php echo strtoupper(date('M', strtotime($ses['date']))); ?></span>
                                    </div>
                                    <div class="session-info">
                                        <h4>Session #SES-<?php echo $ses['sid']; ?></h4>
                                        <p><i class="fa-regular fa-clock"></i>
                                            <?php echo date('h:i A', strtotime($ses['start_time'])); ?> -
                                            <?php echo date('h:i A', strtotime($ses['end_time'])); ?>
                                        </p>
                                        <div class="badges">
                                            <span class="badge time"><?php echo $ses['slot_duration']; ?> Min Slots</span>
                                            <span class="badge count"><?php echo $ses['booked_count']; ?> Booked</span>
                                        </div>
                                    </div>
                                    <div class="session-actions">
                                        <a href="sessionList.php?sid=<?php echo $ses['sid']; ?>" class="btn-icon view">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="mySession.php?delete_id=<?php echo $ses['sid']; ?>" class="btn-icon delete" onclick="return confirm('Delete this session?')">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="list-card">
                        <h3 class="card-title history"><i class="fa-solid fa-clock-rotate-left"></i> Past Sessions</h3>
                        <?php if (empty($pastSessions)): ?>
                            <p style="padding: 20px; color: #777;">No past sessions.</p>
                        <?php else: ?>
                            <?php foreach ($pastSessions as $ses): ?>
                                <div class="session-item">
                                    <div class="date-block">
                                        <span class="day"><?php echo date('d', strtotime($ses['date'])); ?></span>
                                        <span class="month"><?php echo strtoupper(date('M', strtotime($ses['date']))); ?></span>
                                    </div>
                                    <div class="session-info">
                                        <h4>Session #SES-<?php echo $ses['sid']; ?></h4>
                                        <p><i class="fa-regular fa-clock"></i>
                                            <?php echo date('h:i A', strtotime($ses['start_time'])); ?> -
                                            <?php echo date('h:i A', strtotime($ses['end_time'])); ?>
                                        </p>
                                        <div class="badges">
                                            <span class="badge count"><?php echo $ses['booked_count']; ?> Booked</span>
                                        </div>
                                    </div>
                                    <div class="session-actions">
                                        <a href="sessionList.php?sid=<?php echo $ses['sid']; ?>" class="btn-icon view"><i
                                                class="fa-solid fa-eye"></i></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var form = document.getElementById("createSessionForm");

            form.addEventListener("submit", function (e) {
                e.preventDefault();

                var formData = new FormData(form);
                var xhr = new XMLHttpRequest();

                xhr.open("POST", "", true);
                xhr.responseType = "document";

                xhr.onload = function () {
                    if (this.status === 200) {
                        var newList = this.response.getElementById('session-lists');
                        if (newList) {
                            document.getElementById('session-lists').innerHTML = newList.innerHTML;
                            form.reset();
                        }
                    } 
                    else {
                        alert("Error adding session.");
                    }
                };
                xhr.send(formData);
            });
        });
    </script>

</body>
</html>