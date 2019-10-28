<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('../../header.php') ?>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/admin.css">
    <title>Admin Page</title>
</head>
<body>
<?php
    session_start();
?>
<div class="container-form">
    <div class="navbar">
        <div class="back" onclick="window.location.href='students.php'";>
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </div>
        <div class="profile" onclick="window.location.href='profile.php'";>
            <span><?php echo $_SESSION["admin_username"] ?></span>
            <i class="fas fa-user-circle"></i>
        </div>
    </div>
    <div class="card card-body">
        <h5 class="card-heading">Enroll</h5>
        <?php 
        if(!isset($_SESSION['stud_id']))
        {
            $_SESSION['stud_id'] = $_POST['stud_id'];
            $_SESSION['stud_name'] = $_POST['stud_name'];
        }
        ?>
        <form action="validate_new_enrollment.php" method="post">
            <label>Student</label>
            <input type="text" name="class_venue" value="<?php echo $_SESSION['stud_name'] ?>" class="form-control" readonly><br>
            <label>Subject</label>
            <select class="form-control" name="sub_id">
                <?php
                include_once('../../db_connect.php');
                $query = 
                "SELECT * FROM course c
                JOIN `subject` s ON c.crs_id = s.crs_id ";
                $result = $db->query($query);
                if ($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc())
                    {
                        ?>
                        <option value="<?php echo $row['sub_id'] ?>"><?php echo $row['crs_name']." - ".$row['sub_name'] ?></option>
                        <?php
                    }
                }
                ?>
            </select><br>
            <label>Section</label>
            <select class="form-control" name="sect_id">
                <?php
                $query = "SELECT * FROM section s";
                $result = $db->query($query);
                if ($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc())
                    {
                        ?>
                        <option value="<?php echo $row['sect_id'] ?>"><?php echo $row['sect_name'] ?></option>
                        <?php
                    }
                }
                ?>
            </select><br>
            <label>Class</label>
            <select class="form-control" name="class_id">
                <?php
                $query = "SELECT * FROM class c
                        JOIN `subject` sub ON c.sub_id = sub.sub_id
                        JOIN section sect ON c.sect_id = sect.sect_id
                        JOIN `session` sess ON c.sess_id = sess.sess_id
                        ORDER BY sect_name, sub_name";
                $result = $db->query($query);
                if ($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc())
                    {
                        ?>
                        <option value="<?php echo $row['class_id'] ?>"><?php echo $row['sess_name'].", ".$row['sect_name'].", ".$row['sub_name'].": ".$row['class_venue'] ?></option>
                        <?php
                    }
                }
                ?>
            </select><br>
            <input type="hidden" name="stud_id" value="<?php echo $_SESSION['stud_id'] ?>">
            <button type="submit" value="Submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>
</div>
</body>
<?php include_once('../../confirm_resubmission.php') ?>
</html>
