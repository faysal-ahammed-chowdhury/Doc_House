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
                    <form action="" method="POST">
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
                                <option value="15">15 Minutes</option>
                                <option value="30">30 Minutes</option>
                                <option value="60">60 Minutes</option>
                            </select>
                        </div>
                        <button type="submit" class="add-session-btn">Add Session</button>
                    </form>
                    <div class="info-box">
                        <div class="icon"><i class="fa-solid fa-circle-info"></i></div>
                        <div class="text">This will automatically generate appointment slots based on the duration you select.</div>
                    </div>
                </div>

                <div class="session-lists-container">
                    
                    <div class="list-card">
                        <h3 class="card-title"><i class="fa-solid fa-calendar-check"></i> Upcoming Sessions</h3>
                        
                        <div class="session-item">
                            <div class="date-block">
                                <span class="day">30</span>
                                <span class="month">DEC</span>
                            </div>
                            <div class="session-info">
                                <h4>Session #SES-102</h4>
                                <p><i class="fa-regular fa-clock"></i> 09:00 AM - 12:00 PM</p>
                                <div class="badges">
                                    <span class="badge time">15 Min Slots</span>
                                    <span class="badge count">6 Booked</span>
                                </div>
                            </div>
                            <div class="session-actions">
                                <a href="sessionList.php" class="btn-icon view"><i class="fa-solid fa-eye"></i></a>
                                <a href="#" class="btn-icon delete"><i class="fa-solid fa-trash-can"></i></a>
                            </div>
                        </div>

                        <div class="session-item">
                            <div class="date-block">
                                <span class="day">30</span>
                                <span class="month">DEC</span>
                            </div>
                            <div class="session-info">
                                <h4>Session #SES-102</h4>
                                <p><i class="fa-regular fa-clock"></i> 02:00 PM - 05:00 PM</p>
                                <div class="badges">
                                    <span class="badge time">15 Min Slots</span>
                                    <span class="badge count">6 Booked</span>
                                </div>
                            </div>
                            <div class="session-actions">
                                <a href="sessionList.php" class="btn-icon view"><i class="fa-solid fa-eye"></i></a>
                                <a href="#" class="btn-icon delete"><i class="fa-solid fa-trash-can"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="list-card">
                        <h3 class="card-title history"><i class="fa-solid fa-clock-rotate-left"></i> Past Sessions</h3>
                        
                        <div class="session-item">
                            <div class="date-block">
                                <span class="day">28</span>
                                <span class="month">DEC</span>
                            </div>
                            <div class="session-info">
                                <h4>Session #SES-101</h4>
                                <p><i class="fa-regular fa-clock"></i> 09:00 AM - 12:00 PM</p>
                                <div class="badges">
                                    <span class="badge time">15 Min Slots</span>
                                    <span class="badge count">6 Booked</span>
                                </div>
                            </div>
                            <div class="session-actions">
                                <a href="sessionList.php" class="btn-icon view"><i class="fa-solid fa-eye"></i></a>
                            </div>
                        </div>

                        <div class="session-item">
                            <div class="date-block">
                                <span class="day">25</span>
                                <span class="month">DEC</span>
                            </div>
                            <div class="session-info">
                                <h4>Session #SES-099</h4>
                                <p><i class="fa-regular fa-clock"></i> 10:00 AM - 01:00 PM</p>
                                <div class="badges">
                                    <span class="badge time">30 Min Slots</span>
                                    <span class="badge count">4 Booked</span>
                                </div>
                            </div>
                            <div class="session-actions">
                                <a href="sessionList.php" class="btn-icon view"><i class="fa-solid fa-eye"></i></a>
                            </div>
                        </div>
                    </div>

                </div> 
                </div>
        </div>
    </section>

</body>
</html>