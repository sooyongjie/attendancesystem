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
    <?php include_once("../title.php"); ?>
        <h5 class="card-heading">Enrollments</h5>
        <?php
        unset($_SESSION['ce_id']);
        include_once('../../db_connect.php');
        $query = "SELECT * FROM class_enrollment ce
                JOIN `subject` on ce.sub_id = `subject`.sub_id 
                JOIN student on ce.stud_id = student.stud_id 
                JOIN section on ce.sect_id = section.sect_id 
                JOIN class on ce.class_id = class.class_id 
                ORDER BY section.sect_name ";
        $result = $db->query($query);
        if ($result->num_rows > 0)
        {
            ?>
            <table class="table">
                <tr>
                    <th>Student</th>
                    <th>Subject</th>
                    <th>Section</th>
                    <th>Action</th>
                </tr>
            <?php
            while($row = $result->fetch_assoc())
            {
                ?>
                <tr>
                    <td> <?php echo $row["stud_name"]; ?> </td>
                    <td> <?php echo $row["sub_name"]; ?> </td>
                    <td> <?php echo $row["sect_name"]; ?> </td>
                    <td>
                        <div class="record-actions">
                            <form method="post" action="enrollment_edit.php" id="lecturer" class="record_edit">
                                <input type="submit" name="edit" value="View" class="btn btn-secondary btn-sm"/>
                                <input type="hidden" name="ce_id" value="<?php echo $row['ce_id']; ?>"/>
                            </form>
                            <form method="post" action="validate_delete_enrollment.php" id="lecturer" class="record_delete">
                            <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm"/>
                                <input type="hidden" name="ce_id" value="<?php echo $row['ce_id']; ?>"/>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
            </table>
            <?php
        }
        else
        {
            ?>
            <table class="table">
                <tr>
                    <td>There are no records in table 'lecturer'.</td>
                </tr>
            </table>
            <?php
        }
        ?>
    </div>
</div>
</body>
<?php include_once('../../confirm_resubmission.php') ?>
</html>