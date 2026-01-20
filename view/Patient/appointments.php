<?php
require_once "../../middleware/authMiddleware.php";
require_once "../../middleware/patientMiddleware.php";
require_once "../../controller/Patient/appointmentController.php";
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
                        <input type="date" name="filter_date" <?php echo !empty($filterDate) ? "value=\"$filterDate\"" : ''; ?> />
                    </div>
                    <div class="field">
                        <label>Status</label>
                        <select name="status">
                            <option value="" <?php echo empty($filterStatus) ? "selected" : ''; ?>>All</option>
                            <option value="pending" <?php echo ($filterStatus == "pending") ? "selected" : ''; ?>>Pending</option>
                            <option value="accepted" <?php echo ($filterStatus == "accepted") ? "selected" : ''; ?>>Accepted</option>
                            <option value="cancelled" <?php echo ($filterStatus == "cancelled") ? "selected" : ''; ?>>Cancelled</option>
                            <option value="rejected" <?php echo ($filterStatus == "rejected") ? "selected" : ''; ?>>Rejected</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-filter">
                        <i class="fa-solid fa-filter"></i> Filter
                    </button>
                    <a href="/Doc_House/view/Patient/appointments.php" type="submit" class="btn-reset">Reset</a>
                </form>
            </div>
            <div class="list appointment-list">
                <table>
                    <thead>
                        <tr>
                            <th>Doctor Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($appointmentList) == 0) {
                        ?>
                            <tr>
                                <td colspan="100%" style="text-align:center;">
                                    <p style="display: flex; justify-content: center; margin-top: 20px;">No Data Found</p>
                                </td>
                            </tr>

                            <?php
                        } else {
                            foreach ($appointmentList as $singleAppointment) {
                            ?>
                                <tr id="apt-<?php echo $singleAppointment['aptid'] ?>">
                                    <td class="name"><?php echo $singleAppointment['doctor_name'] ?></td>
                                    <td class="date"><?php echo date("d-m-Y", strtotime($singleAppointment["date"])) ?></td>
                                    <td class="date"><?php echo date("h:i A", strtotime($singleAppointment["time"])); ?></td>
                                    <td class="status-td">
                                        <span class="status <?php echo $singleAppointment['status'] ?>"><?php echo strtoupper($singleAppointment['status']) ?></span>
                                    </td>
                                    <td class="actions">
                                        <?php echo $singleAppointment['status'] == 'pending' ?
                                            "<button onclick=\"cancelAppointment($singleAppointment[aptid])\" class=\"cancel\">Cancel</button>" : '';
                                        ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php include_once "toast.php"; ?>
        </div>
    </section>
    <?php include_once "footer.php" ?>

    <script src="js/script.js"></script>
</body>

</html>