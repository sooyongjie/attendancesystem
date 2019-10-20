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
        <div class="back" onclick="window.location.href='attendance_view_by_subject.php'";>
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
        include_once("../db_connect.php");
        if(!isset($_SESSION['att_id']))
        {
            $_SESSION['att_id'] = $_POST['att_id'];
        }
        $query = 
        "SELECT * FROM attendance att
        JOIN student stud ON att.stud_id = stud.stud_id 
        WHERE att_id = '".$_SESSION['att_id']."' ";
        $result = $db->query($query);
        
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                ?>
                <form action="validate_update_attendance.php" method="post" id="newClass">
                    <label>Student</label>
                    <input type="text" name="stud_name" class="form-control" value="<?php echo $row['stud_name']; ?>" readonly><br>
                    <label>Attendance Status</label>
                    <select class="form-control" name="att_status">
                        <option value="1">Present</option>
                        <option value="2">Absent</option>
                        <option value="3">Sick</option>
                        <option value="4">On Leave</option>
                    </select><br>
                    <input type="hidden" name="att_id" class="form-control" value="<?php echo $row['att_id']; ?>" readonly>
                    <button type="submit"value="Submit" class="btn btn-secondary">Submit</button>
                </form>
                <?php
            }
        }
        else
        {
            
        }
        ?>
    </div>
</div>

</body>
<?php include_once('../confirm_resubmission.php') ?>
</html>