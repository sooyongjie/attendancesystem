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
        if(!isset($_SESSION['class_id']))
        {
            $_SESSION['class_id'] = $_POST['class_id'];
        }
        
        include_once('../../db_connect.php');

        $query = "SELECT * FROM class
                INNER JOIN `subject` on class.sub_id = `subject`.sub_id
                INNER JOIN `session` on class.sess_id = `session`.sess_id
                INNER JOIN section on class.sect_id = section.sect_id 
                WHERE class_id = '". $_SESSION['class_id'] ."'";
        $result = $db->query($query);
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                ?>
                <form action="validate_update_class.php" method="post" id="editlecturer">
                    <label>Class ID</label>
                    <input type="text" name="class_id" class="form-control" value="<?php echo $row['class_id']; ?>" readonly><br>
                    <label>Class Venue</label>
                    <input type="text" name="class_venue" class="form-control" value="<?php echo $row['class_venue']; ?>"><br>
                    <label>Class Day</label>
                    <input type="text" name="class_day" class="form-control" value="<?php echo $row['class_day']; ?>"><br>
                    <label>Class Start</label>
                    <input type="text" name="class_start" class="form-control" value="<?php echo $row['class_start']; ?>"><br>
                    <label>Class End</label>
                    <input type="text" name="class_end" class="form-control" value="<?php echo $row['class_end']; ?>"><br>
                    <label>Subject Name</label>
                    <select class="form-control" name="sub_id">
                        <?php
                        $query2 = "SELECT * FROM `subject`";
                        $result2 = $db->query($query2);
                        if ($result2->num_rows > 0)
                        {
                            while($row2 = $result2->fetch_assoc())
                            {
                                if($row['sub_id']==$row2['sub_id'])
                                {
                                    echo "<option value='".$row2['sub_id']."' selected>".$row2['sub_name']."</option>";
                                }
                                else
                                {
                                    echo "<option value='".$row2['sub_id']."'>".$row2['sub_name']."</option>";
                                }
                            }
                        }
                    ?>
                    </select><br>
                    <label>Session</label>
                    <select class="form-control" name="sess_id">
                        <?php
                        $query3 = "SELECT * FROM `session`";
                        $result3 = $db->query($query3);
                        if ($result3->num_rows > 0)
                        {
                            while($row3 = $result3->fetch_assoc())
                            {
                                if($row['sess_id']==$row3['sess_id'])
                                {
                                    echo "<option value='".$row3['sess_id']."' selected>".$row3['sess_name']."</option>";
                                }
                                else
                                {
                                    echo "<option value='".$row3['sess_id']."'>".$row3['sess_name']."</option>";
                                }
                            }
                        }
                        ?>
                    </select><br>
                    <label>Section</label>
                    <select class="form-control" name="sect_id">
                        <?php
                        $query3 = "SELECT * FROM section";
                        $result3 = $db->query($query3);
                        if ($result3->num_rows > 0)
                        {
                            while($row3 = $result3->fetch_assoc())
                            {
                                if($row['sect_id']==$row3['sect_id'])
                                {
                                    echo "<option value='".$row3['sect_id']."' selected>".$row3['sect_name']."</option>";
                                }
                                else
                                {
                                    echo "<option value='".$row3['sect_id']."'>".$row3['sect_name']."</option>";
                                }
                            }
                        }
                    ?>
                    </select><br>
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
