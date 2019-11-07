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
    <div>
        <?php
            $d = getdate();
            if($d['mday'] < 10)
            {
                $d['mday'] = "0".$d['mday'];
            }
            $date = $d['year']."-".$d['mon']."-".$d['mday'];
            echo "<br><br>";
        ?>
    </div>
    <div class="card card-body">
        <?php
        if(!isset($_SESSION['class_id']))
        {
            $_SESSION['class_id'] = $_POST['class_id'];
        }
        include_once("../db_connect.php");
        $query = "SELECT * FROM class_enrollment 
        INNER JOIN student on class_enrollment.stud_id = student.stud_id 
        WHERE class_id = '".$_SESSION['class_id']."' 
        ORDER BY student.stud_name";

        $result = $db->query($query);
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                $stud_id = $row['stud_id'];
                $sect_id = $row['sect_id'];
                $query2 = "INSERT INTO attendance (stud_id, att_status, sect_id, sub_id, class_id, lect_id, att_date)
                VALUES ('".$stud_id."', '".$_POST[$stud_id]."', '".$sect_id."', 
                '".$_SESSION['sub_id']."', '".$_SESSION['class_id']."', '".$_SESSION['lect_id']."', '".$date."')";
                if ($db->query($query2) === TRUE)
                {
                }
                else
                {
                    echo "Error: " . $query2 . "<br>" . $db->error;
                    exit();
                }
            }
            echo "Attendance submitted.";
            $lect_id = $_SESSION['lect_id'];
            $sub_id = $_SESSION['sub_id'];
            $class_id = $_SESSION['class_id'];
            include_once('attendance_alert.php');
            header( "refresh:1;url=classes-from-subject.php" );
        }
        ?>
    </div>
</div>
</body>
<?php include_once('../confirm_resubmission.php') ?>
</html>