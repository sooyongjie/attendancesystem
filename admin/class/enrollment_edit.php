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
        <h5 class="card-heading">Edit Enrollment</h5>
        <?php
        if(!isset($_SESSION['ce_id']))
        {
            $_SESSION['ce_id'] = $_POST['ce_id'];
        }
        
        include_once('../../db_connect.php');

        $query = "SELECT * FROM class_enrollment ce
                INNER JOIN student on ce.stud_id = student.stud_id 
                INNER JOIN `subject` on ce.sub_id = `subject`.sub_id
                INNER JOIN section on ce.sect_id = section.sect_id 
                INNER JOIN class on ce.class_id = class.class_id
                WHERE ce_id = '". $_SESSION['ce_id'] ."'";
        $result = $db->query($query);
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                ?>
                <form action="validate_update_enrollment.php" method="post" id="editlecturer">
                    <label>Class Enrollment ID</label>
                    <input type="text" name="ce_id" class="form-control" value="<?php echo $row['ce_id']; ?>" readonly><br>
                    <label>Student</label>
                    <input type="text" name="stud_name" class="form-control" value="<?php echo $row['stud_name']; ?>" readonly><br>
                    <label>Subject</label>
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
                    <label>Section</label>
                    <select class="form-control" name="sect_id">
                        <?php
                        $query2 = "SELECT * FROM section";
                        $result2 = $db->query($query2);
                        if ($result2->num_rows > 0)
                        {
                            while($row2 = $result2->fetch_assoc())
                            {
                                if($row['sect_id']==$row2['sect_id'])
                                {
                                    echo "<option value='".$row2['sect_id']."' selected>".$row2['sect_name']."</option>";
                                }
                                else
                                {
                                    echo "<option value='".$row2['sect_id']."'>".$row2['sect_name']."</option>";
                                }
                            }
                        }
                    ?>
                    </select><br>
                    <label>Class</label>
                    <select class="form-control" name="class_id">
                        <?php
                        $query3 = "SELECT * FROM class c
                        JOIN `subject` sub ON c.sub_id = sub.sub_id
                        JOIN section sect ON c.sect_id = sect.sect_id
                        JOIN `session` sess ON c.sess_id = sess.sess_id
                        ORDER BY sect_name, sub_name";
                        $result3 = $db->query($query3);
                        if ($result3->num_rows > 0)
                        {
                            while($row3 = $result3->fetch_assoc())
                            {
                                if($row['class_id']==$row3['class_id'])
                                {
                                    echo "<option value='".$row3['class_id']."' selected>".$row3['class_venue']."</option>";
                                }
                                else
                                {
                                    echo "<option value='".$row3['class_id']."'>".$row3['class_venue']."</option>";
                                }
                            }
                        }
                    ?>
                    </select><br>
                    <input type="hidden" name="stud_id" value="<?php echo $row['stud_id'] ?>">
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
