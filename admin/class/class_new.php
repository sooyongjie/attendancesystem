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
        <div class="back" onclick="window.location.href='classes.php'";>
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </div>
        <div class="profile" onclick="window.location.href='profile.php'";>
            <span><?php echo $_SESSION["admin_username"] ?></span>
            <i class="fas fa-user-circle"></i>
        </div>
    </div>
    <div class="card card-body">
        <form action="validate_new_class.php" method="post" id="newclass">
            <label>Class Venue</label>
            <input type="text" name="class_venue" class="form-control" placeholder="A-L3-R101"><br>
            <label>Class Day</label>
            <select class="form-control" name="class_day">
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
            </select><br>
            <label>Class Start</label>
            <select class="form-control" name="class_start">
                <option value="08:00:00">8 a.m.</option>
                <option value="09:00:00">9 a.m.</option>
                <option value="10:00:00">10 a.m.</option>
                <option value="11:00:00">11 a.m.</option>
                <option value="12:00:00">12 p.m.</option>
                <option value="13:00:00">1 p.m.</option>
                <option value="14:00:00">2 p.m.</option>
                <option value="15:00:00">3 p.m.</option>
                <option value="16:00:00">4 p.m.</option>
                <option value="17:00:00">5 p.m.</option>
                <option value="18:00:00">6 p.m.</option>
            </select><br>
            <label>Class End</label>
            <select class="form-control" name="class_end">
                <option value="08:00:00">8 a.m.</option>
                <option value="09:00:00">9 a.m.</option>
                <option value="10:00:00" selected="selected">10 a.m.</option>
                <option value="11:00:00">11 a.m.</option>
                <option value="12:00:00">12 p.m.</option>
                <option value="13:00:00">1 p.m.</option>
                <option value="14:00:00">2 p.m.</option>
                <option value="15:00:00">3 p.m.</option>
                <option value="16:00:00">4 p.m.</option>
                <option value="17:00:00">5 p.m.</option>
                <option value="18:00:00">6 p.m.</option>
            </select><br>
            <label>Subject Name</label>
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
            <label>Session</label>
            <select class="form-control" name="sess_id">
                <?php
                include_once('../../db_connect.php');
                $query = "SELECT * FROM `session`";
                $result = $db->query($query);
                if ($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc())
                    {
                        echo "<option value='".$row['sess_id']."'>".$row['sess_name']."</option>";
                    }
                }
                ?>
            </select><br>
            <label>Section</label>
            <select class="form-control" name="sect_id">
                <?php
                include_once('../../db_connect.php');
                $query = "SELECT * FROM section";
                $result = $db->query($query);
                if ($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc())
                    {
                        echo "<option value='".$row['sect_id']."'>".$row['sect_name']."</option>";
                    }
                }
                ?>
            </select><br>
            <button type="submit" form="newclass" value="Submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>
</div>
</body>
<?php include_once('../../confirm_resubmission.php') ?>
</html>
