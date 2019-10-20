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
    </div>
    <div class="card card-body">
        <?php
        include_once("../title.php");
        // if(!isset($_SESSION['sub_id']) && !isset($_SESSION['sub_name']))
        // {
        //     $_SESSION['sub_id'] = $_POST['sub_id'];
        //     $_SESSION['sub_name'] = $_POST['sub_name'];
        // }
        include_once("../db_connect.php");
        include_once('notification_send.php');

        $query = "SELECT * FROM attendance 
                INNER JOIN `student` on attendance.stud_id = `student`.stud_id
                WHERE sub_id = '1'
                ORDER BY student.stud_name";
        $result = $db->query($query);
        if ($result->num_rows > 0)
        {
            ?>
            <h5 class="card-heading"><?php echo "Test Attendance Alert" ?></h5>
            <?php
            $absent = array(); 
            $stud_id = array(); 
            $class_id = 1;
            $i = 0;                
            
            while($row = $result->fetch_assoc())
            {
                if(!isset($absent[$row['stud_name']]))  // if name doesn't exist in absent array
                {
                    $absent[$row['stud_name']] = 0;
                    $stud_id[$i] = $row['stud_id'];
                    $i++;
                }
                if($row['att_status'] == 2) // if absent
                {
                    $absent[$row['stud_name']]++;
                }
            }
        }   
        else
        {
            ?>
            <h5><?php echo $_SESSION['sub_name'] ?></h5><br>
            
            <?php
            echo "No attendance found.";
        }
        ?>
        <table class="table">
            <tr>
                <th>Student</th>
                <th class="text-center">Absent Count</th>
                <th class="text-center">Alert</th>
            </tr>
            <form method="post" action="attendance_submission.php" id="lecturer" class="record_edit">
        <?php

        $query = 
        "SELECT DISTINCT(stud_name), attendance.stud_id, sub_id, class_id, lect_id
        FROM attendance 
        INNER JOIN `student` on attendance.stud_id = `student`.stud_id
        WHERE sub_id = '1'
        ORDER BY student.stud_name";

        $result = $db->query($query);
        if ($result->num_rows > 0)
        {             
            while($row = $result->fetch_assoc())
            {
                ?>
                <tr>
                    <!-- Student Name -->
                    <td class="student-name">
                        <?php echo $row['stud_name'] ?>
                    </td>
                    <!-- Absent Count -->
                    <td class="text-center">
                        <?php echo $absent[$row['stud_name']] ?>
                    </td>
                    <td class="text-center">
                    <?php
                    if($absent[$row['stud_name']] == 4)
                    {
                        echo "1";
                        checkNotificationTable($row['stud_id'], $row['lect_id'], $row['sub_id'], $row['class_id'], 1);
                    }
                    else if($absent[$row['stud_name']] ==5 & $absent[$row['stud_name']] < 8)
                    {
                        echo "2";
                        checkNotificationTable($row['stud_id'], $row['lect_id'], $row['sub_id'], $row['class_id'], 2);
                    }
                    else if($absent[$row['stud_name']] >= 8)
                    {
                        echo "3";
                    }
                    else
                    {
                        echo "-";
                    }
                    ?>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        </table>
    </div>
</div>

</body>
<?php include_once('../confirm_resubmission.php') ?>
</html>