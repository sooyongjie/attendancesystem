<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('../../header.php') ?>
    <link rel="stylesheet" href="../../css/style.css">
    <title>Admin Page</title>
</head>
<body>
<?php
    session_start();
?>
<div class="container-form">
    <div class="back" onclick="window.location.href='classes.php'";>
        <i class="fas fa-arrow-left" ></i>
        <span class="welcome-admin">Back</span>
    </div>
    <div class="card card-body">
        <?php
        if(!isset($_SESSION['crs_id']))
        {
            $_SESSION['crs_id'] = $_POST['crs_id'];
        }
        include_once('../../db_connect.php');
        $query = "SELECT * FROM course
                WHERE crs_id = '". $_SESSION['crs_id'] ."'";
        $result = $db->query($query);
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                ?>
                <form action="validate_update_course.php" method="post" id="editlecturer">
                    <label>Course ID</label>
                    <input type="text" name="crs_id" class="form-control" value="<?php echo $row['crs_id']; ?>" readonly><br>
                    <label>Course Name</label>
                    <input type="text" name="crs_name" class="form-control" value="<?php echo $row['crs_name']; ?>"><br>
                    <button type="submit" form="editlecturer" value="Submit" class="btn btn-secondary">Update</button>
                </form>
                <?php
            }
        }
        else echo "Wadafak";
        ?>
    </div>
</div>
</body>
<?php include_once('../../confirm_resubmission.php') ?>
</html>
