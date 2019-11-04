<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('../header.php') ?>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/student.css">
    <title>Student</title>
</head>
<body>

<?php
    session_start();
?>

<div class="container-form">
    <div class="navbar">
        <div class="back" onclick="window.location.href='../index.html'";>
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </div>
        <div class="profile" onclick="window.location.href='profile.php'";>
            <span><?php echo $_SESSION['stud_name'] ?></span>
            <i class="fas fa-user-circle"></i>
        </div>
    </div>
    <div class="card card-body">
        <?php
        include_once("../title.php");
        include_once("../db_connect.php");
        ?>
        <h5 class=""><i class="far fa-clipboard heading-icon"></i>Attendance Report</h5>
        <?php
        $query = 
        "SELECT DISTINCT(att.sub_id), sub.sub_name FROM attendance att
        JOIN `subject` sub ON att.sub_id = sub.sub_id  
        WHERE att.stud_id = '".$_SESSION['stud_id']."'";
        $result = $db->query($query);
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                // displays each subject
                ?>
                <br>
                <h5 class="card-heading"> <?php echo $row['sub_name'] ?> </h5>
                <?php
                $query2 = 
                "SELECT * FROM attendance 
                WHERE stud_id = '".$_SESSION['stud_id']."'
                AND sub_id = '".$row['sub_id']."' ";
                $result2 = $db->query($query2);
                if ($result2->num_rows > 0)
                {
                    ?>
                    <table class='table text-center'>
                        <tr>
                            <td></td>
                            <td>Status</td>
                            <td>Date</td>
                        </tr>
                    <?php
                    $i = 0; $present = 0; 
                    while($row2 = $result2->fetch_assoc())
                    {
                        $i++; 
                        ?>
                        <tr>
                            <td> <?php echo "Week ".$i; ?> </td>    
                        <?php
                        if($row2['att_status'] == '1')
                        {
                            ?>
                                <td><i title='Present' class='fas fa-check-circle'></i></td>
                            <?php
                            $present++;
                        }
                        else if($row2['att_status'] == '2')
                        {
                            ?>
                                <td><i title='Absent' class='fas fa-times-circle'></i></td>
                            <?php
                        }
                        else if($row2['att_status'] == '3')
                        {
                            ?>
                                <td><i title='Sick' class='fas fa-bed'></i></td>
                            <?php
                        }
                        else if($row2['att_status'] == '4')
                        {
                            ?>
                                <td><i title='On Leave' class='fas fa-walking'></i></td>
                            <?php
                        }
                        ?>
                        <td> <?php echo $row2['att_date'] ?> </td>
                        </tr>
                        <?php
                    }
                    ?>
                    <h6 class="card-sub-heading"><?php echo "Summary: ".$present."/".$i." classes attended" ?></h6>
                    </table>
                    <?php
                }
                else
                {
                    echo "No attendance recorded.";
                    //echo "Error: " . $query2 . "<br>" . $db->error;
                }
            }
        }
        else
        {
            echo "<br>No subject enrolled. Please contact admin for subject enrollment.";
            // echo "Error: " . $query . "<br>" . $db->error;
        }
        ?>
    </div>
</div>

</body>
</html>