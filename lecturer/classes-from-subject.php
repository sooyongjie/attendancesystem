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
        if(!isset($_SESSION['sub_id']))
        {
            $_SESSION['sub_id'] = $_POST['id'];
        }
        unset($_SESSION['class_id']);
        include_once("../db_connect.php");
        $query = "SELECT * FROM subject WHERE sub_id = '".$_SESSION['sub_id']."' ";
        $result = $db->query($query);
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                ?> <h5 class="card-heading"><?php echo $row['sub_name'] ?></h5> <?php
                $_SESSION['sub_name'] = $row['sub_name'];
            }
        }
        ?>
        <?php
        $query = "SELECT * FROM class 
        INNER JOIN section on class.sect_id = section.sect_id 
        INNER JOIN `session` on class.sess_id = `session`.sess_id 
        WHERE sub_id = '".$_SESSION['sub_id']."' ";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
            ?>
            <table class="table">
                <tr>
                    <th>Session</th>
                    <th>Section</th>
                    <th>Start</th>
                    <th>End</th>
                    <th></th>
                </tr>
            <?php
            while($row = $result->fetch_assoc())
            {
                ?>
                <tr>
                    <form method="post" action="attendance_new.php" id="lecturer" class="record_edit">
                        <td><?php echo $row['sess_name']; ?></td>
                        <td><?php echo $row['sect_name']; ?></td>
                        <td><?php echo $row['class_start']; ?></td>
                        <td><?php echo $row['class_end']; ?></td>
                        <td><input type="submit" name="go" value="Go" class="btn btn-success btn-sm"/></td>
                        <input type="hidden" name="class_id" value="<?php echo $row['class_id']; ?>"/>
                    </form>
                </tr>
                
                <?php
            }
            echo "</table>";
        } else {
            ?>
                <hr><p>There is no class for the subject.</p>
            <?php
        }
        

        ?>
        
    </div>
</div>
</body>
<?php include_once('../confirm_resubmission.php') ?>
</html>