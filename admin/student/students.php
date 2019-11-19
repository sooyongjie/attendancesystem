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
        <div class="back" onclick="window.location.href='../main.php'";>
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </div>
        <div class="profile" onclick="window.location.href='profile.php'";>
            <span><?php echo $_SESSION["admin_username"] ?></span>
            <i class="fas fa-user-circle"></i>
        </div>
    </div>
    <div class="card card-body">
    <?php include_once("../title_sub.php"); ?>
        <h5 class="card-heading">Students</h5>
        <button type="button" class="btn btn-light btn-sm btn-block add" onclick="location.href='student_new.php';">
        <i class="fas fa-plus"></i>
        <span>Add student</span>
        </button>
        <?php
        
        include_once('../../db_connect.php');
        $query = "SELECT * FROM student";
        $result = $db->query($query);
        
        if ($result->num_rows > 0) {
            ?>
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
            <?php
            while($row = $result->fetch_assoc())
            {
                ?>
                <tr>
                    <td> <?php echo $row["stud_name"]; ?> </td>
                    <td> <?php echo $row["stud_email"]; ?> </td>
                    <td>
                        <div class="record-actions">
                            <form method="post" action="enrollment_new.php" class="record_enroll">
                                <input type="submit" name="edit" value="Enroll" class="btn btn-success btn-sm"/>
                                <input type="hidden" name="stud_id" value="<?php echo $row['stud_id']; ?>"/>
                                <input type="hidden" name="stud_name" value="<?php echo $row['stud_name']; ?>"/>
                            </form>
                            <form method="post" action="student_edit.php" class="record_edit">
                                <input type="submit" name="edit" value="Edit" class="btn btn-secondary btn-sm"/>
                                <input type="hidden" name="stud_id" value="<?php echo $row['stud_id']; ?>"/>
                            </form>
                            <form method="post" action="validate_delete_student.php" class="record_delete">
                                <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm"/>
                                <input type="hidden" name="stud_id" value="<?php echo $row['stud_id']; ?>"/>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php
            }
            echo "</table>";
        } else {
            echo "Wadafak";
        }
        
        unset($_SESSION['stud_id']);
        
        ?>
    </div>
</div>
</body>
<?php include_once('../../confirm_resubmission.php') ?>
</html>