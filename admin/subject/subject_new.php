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
    <div class="back" onclick="window.location.href='lecturers.php'";>
        <i class="fas fa-arrow-left" ></i>
        <span class="welcome-admin">Back</span>
    </div>
    <div class="card card-body">
        <form action="validate_new_subject.php" method="post" id="newsubject">
            <label>Subject Name</label>
            <input type="text" name="sub_name" class="form-control" autocomplete="off"><br>
            <label>Course Name</label>
            <select class="form-control" name="crs_id">
                <?php
                include_once('../../db_connect.php');
                $query = "SELECT * FROM course";
                $result = $db->query($query);
                if ($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc())
                    {
                        echo "<option value='".$row['crs_id']."'>".$row['crs_name']."</option>";
                    }
                }
                ?>
            </select><br>
            <label>Lecturer Name</label>
            <select class="form-control" name="lect_id">
                <?php
                include_once('../../db_connect.php');
                $query = "SELECT * FROM lecturer";
                $result = $db->query($query);
                if ($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc())
                    {
                        echo "<option value='".$row['lect_id']."'>".$row['lect_name']."</option>";
                    }
                }
                ?>
            </select><br>
            
            <button type="submit" form="newsubject" value="Submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>
</div>
</body>
<?php include_once('../../confirm_resubmission.php') ?>
</html>
