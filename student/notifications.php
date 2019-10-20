<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('../header.php') ?>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/student.css">
    <link rel="stylesheet" href="../css/notification.css">
    <title>Lecturer Page</title>
</head>
<body>

<?php
    session_start();
?>

<div class="container-form">
    <div class="navbar">
        <div class="back" onclick="window.location.href='main.php'";>
            <i class="fas fa-arrow-left" ></i>
            <span class="welcome-admin">Back</span>
        </div>
    </div>
    <div class="card card-body">
        <?php
        include_once("../db_connect.php");
        ?>
        <div class="card-title">
            <h2 class="title">Attendance </h2>
            <h6 class="subtitle">by INTI Colleges & Universities</h6>
            <div class="bell mx-auto" onclick="window.location.href='notifications.php'";>
                <i class="fas fa-bell" title="Notification"></i>
            </div>
            <div class="logout mx-auto" onclick="window.location.href='../index.html'";>
                <i class="fas fa-sign-out-alt" title="Logout" ></i>
            </div>
        </div>
        <h5 class="card-heading"><i class="fas fa-pen-alt heading-icon"></i>Notifications</h5>
            
            <?php
                $query = "SELECT * FROM `notification` WHERE stud_id ='".$_SESSION['stud_id']."'";
                $result = $db->query($query);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc())
                    {
                        ?>
                        <div class="notification">
                            <div class="notification-title">
                                <?php echo $row['notif_title'] ?>
                            </div>
                            <div class="notification-body">
                                <?php echo $row['notif_body'] ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                else
                {
                    echo "You have no notification.";
                }
            ?>
    </div>
</div>

</body>
<?php include_once('../confirm_resubmission.php') ?>
</html>