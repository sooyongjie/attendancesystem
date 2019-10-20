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
        <div class="back" onclick="window.location.href='attendance_subject_list.php'";>
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
        if(!isset($_SESSION['class_id']) && !isset($_SESSION['sub_id']))
        {
            $_SESSION['class_id'] = $_POST['class_id'];
            $_SESSION['sub_id'] = $_POST['sub_id'];
        }
        include_once("../db_connect.php");
        $query = "SELECT * FROM attendance 
                INNER JOIN `subject` on attendance.sub_id = `subject`.sub_id 
                INNER JOIN `student` on attendance.stud_id = `student`.stud_id
                WHERE class_id = '".$_SESSION['class_id']."'
                ORDER BY student.stud_name";
        $result = $db->query($query);
        if ($result->num_rows > 0)
        {
            $row1 = $result->fetch_assoc();
            {
                ?>
                <h5 class="card-heading"><?php echo $row1['sub_name'] ?></h5>
                <?php
            }
            ?>
            <table class="table">
                <tr>
                    <th>Student</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Action</th>
                </tr>
            <?php
            while($row = $result->fetch_assoc())
            {
                ?>
                <tr>
                    <td class="student-name"><?php echo $row['stud_name'] ?></td>
                    <td class="text-center">
                        <?php
                        if ($row['att_status'] == 1) echo "<i title='Present' class='fas fa-check-circle'></i>";
                        else if($row['att_status'] == 2) echo "<i title='Absent' class='fas fa-times-circle'></i>";
                        else if($row['att_status'] == 3) echo "<i title='Sick' class='fas fa-bed'></i>";
                        else if($row['att_status'] == 4) echo "<i title='On Leave' class='fas fa-walking'></i>";
                        ?>
                    </td>
                    <td class="text-center"><?php echo $row['att_date'] ?></td>
                    <td class="text-center">
                    <form method="post" action="attendance_edit.php">
                        <input type="submit" name="edit" value="Edit" class="btn btn-danger btn-sm"/>
                        <input type="hidden" name="att_id" value="<?php echo $row['att_id']; ?>"/>
                    </form>
                    </td>
                </tr>
                <?php
            }
        }   
        else
        {
            echo "No attendance found.";
        } 
        unset($_SESSION['att_id'])
        ?>
    </div>
</div>

</body>
<?php include_once('../confirm_resubmission.php') ?>
</html>