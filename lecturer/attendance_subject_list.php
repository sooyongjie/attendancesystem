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
    <?php include_once("../title.php"); ?>
    <h5 class=""><i class="far fa-clipboard heading-icon"></i>View Attendance</h5><hr>
        <?php
        include_once("../db_connect.php");
        $query = 
        "SELECT * FROM `subject` 
        WHERE lect_id = '".$_SESSION['lect_id']."'";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc())
            {
                ?>
                <h5 class="card-heading"> <?php echo $row['sub_name'] ?> </h5>
                <?php
                $query2 = 
                "SELECT * FROM class
                INNER JOIN section ON class.sect_id = section.sect_id 
                WHERE sub_id = '".$row['sub_id']."'";
                $result2 = $db->query($query2);
                if ($result2->num_rows > 0) {
                    while($row2 = $result2->fetch_assoc())
                    {   
                        ?>
                        <form method="post" action="attendance_view_by_subject.php" id="subject" class="record_edit">
                            <input type="submit" name="edit" value="<?php echo $row2['sect_name']; ?>" class="btn btn-light btn-block"/>
                            <br>
                            <input type="hidden" name="class_id" value="<?php echo $row2['class_id']; ?>"/>
                            <input type="hidden" name="sub_id" value="<?php echo $row2['sub_id']; ?>"/>
                        </form>
                        <?php
                    }
                }
                else
                {
                    echo "FUCK!";
                }
            }
        } 
        else 
        {
            ?>
                <p>No subjects are taught by you.</p>
            <?php
        }
        unset($_SESSION['class_id'], $_SESSION['sub_id']);
        ?>
    </div>
</div>
</body>
<?php include_once('../confirm_resubmission.php') ?>
</html>