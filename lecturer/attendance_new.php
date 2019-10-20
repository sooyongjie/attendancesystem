<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('../header.php') ?>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/lecturer.css">
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
        <div class="profile" onclick="window.location.href='profile.php'";>
            <span><?php echo $_SESSION['lect_name'] ?></span>
            <i class="fas fa-user-circle"></i>
        </div>
    </div>
    <div class="card card-body">
        <?php
        include_once("../title.php");
        if(!isset($_SESSION['class_id']))
        {
            $_SESSION['class_id'] = $_POST['class_id'];
        }
        include_once("../db_connect.php");
        ?>
        <h5 class="card-heading"><?php echo $_SESSION['sub_name'] ?></h5>
        <?php
        $query = "SELECT * FROM class_enrollment 
        INNER JOIN student on class_enrollment.stud_id = student.stud_id 
        WHERE class_id = '".$_SESSION['class_id']."' 
        ORDER BY student.stud_name";
        $result = $db->query($query);
        if ($result->num_rows > 0)
        {
            ?>
            <table class="table">
                <tr>
                    <th>Student</th>
                    <th>Present</th>
                    <th>Absent</th>
                    <th>Sick</th>
                    <th>On Leave</th>
                </tr>
                <form method="post" action="attendance_submission.php" id="lecturer" class="record_edit">
            <?php
            while($row = $result->fetch_assoc())
            {
                ?>
                <tr>
                    <td><?php echo $row['stud_name']; ?></td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="<?php echo $row['stud_id'] ?>" value="1" id="present" checked>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="<?php echo $row['stud_id'] ?>" value="2" id="absent">
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="<?php echo $row['stud_id'] ?>" value="3" id="sick">
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="<?php echo $row['stud_id'] ?>" value="4" id="onleave">
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?> 
            </table>
            <input type="submit" name="go" value="Submit" class="btn btn-success"/>
            </form> <?php
        } else {
            ?>
                <hr><p>No students enrolled in this section.</p>
            <?php
        }
        ?>
    </div>
</div>
</body>
<?php include_once('../confirm_resubmission.php') ?>
</html>