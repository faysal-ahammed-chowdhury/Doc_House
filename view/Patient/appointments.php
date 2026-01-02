<?php
require_once "../../middleware/authMiddleware.php";
require_once "../../middleware/patientMiddleware.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Appointments</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <?php
    $cur_page = "appointments";
    include_once "header.php";
    ?>

    <section class="page-header">
        <div class="container">
            <h2>My Appointments</h2>
            <p>Track the status of your past and upcoming doctor visits.</p>
        </div>
    </section>

    <section class="appointments-section">
        <div class="container">
            <div class="filter-bar">
                <form action="" method="GET" class="filter-form">
                    <div class="field">
                        <label>Date</label>
                        <input type="date" name="filter_date" />
                    </div>
                    <div class="field">
                        <label>Status</label>
                        <select name="status">
                            <option value="all">All</option>
                            <option value="pending">Pending</option>
                            <option value="accepted">Accepted</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-filter">
                        <i class="fa-solid fa-filter"></i> Filter
                    </button>
                    <button type="submit" class="btn-reset">Reset</button>
                </form>
            </div>
            <div class="list appointment-list">
                <table>
                    <thead>
                        <tr>
                            <th>Doctor Name</th>
                            <th>Specialization</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="name">Siyam Talukder</td>
                            <td>Dentist</td>
                            <td class="date">10 AM, Dec 30, 2025</td>
                            <td>
                                <span class="status accepted">Accepted</span>
                            </td>
                            <td class="actions"></td>
                        </tr>
                        <tr>
                            <td class="name">Mehedi Hasan</td>
                            <td>Dentist</td>
                            <td class="date">12 AM, Dec 25, 2023</td>
                            <td>
                                <span class="status rejected">Rejected</span>
                            </td>
                            <td class="actions"></td>
                        </tr>
                        <tr>
                            <td class="name">Arafat Abdullah</td>
                            <td>Dentist</td>
                            <td class="date">11 AM, Dec 31, 2024</td>
                            <td>
                                <span class="status pending">Pending</span>
                            </td>
                            <td class="actions">
                                <a class="cancel" href="">Cancel</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <?php include_once "../shared/footer.php" ?>
</body>

</html>