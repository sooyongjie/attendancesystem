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
        <h5 class="card-heading">Courses</h5>
        <button type="button" class="btn btn-light btn-sm btn-block add" onclick="location.href='course_new.php';">
        <i class="fas fa-plus"></i>
        <span>Add course</span>
        </button>
        <?php
        unset($_SESSION['crs_id']);
        include_once('../../db_connect.php');
        $query = "SELECT * FROM course";
        $result = $db->query($query);
        if ($result->num_rows > 0)
        {
            ?>
                <table class="table">
                    <tr>
                        <th>Course Name</th>
                        <th>Action</th>
                    </tr>
            <?php
            while($row = $result->fetch_assoc())
            {
                ?>
                <tr>
                    <td> <?php echo $row["crs_name"]; ?> </td>
                    <td>
                        <div class="record-actions">
                            <form method="post" action="course_edit.php" id="lecturer" class="record_edit">
                                <input type="submit" name="edit" value="View" class="btn btn-secondary btn-sm"/>
                                <input type="hidden" name="crs_id" value="<?php echo $row['crs_id']; ?>"/>
                            </form>
                            <form method="post" action="validate_delete_course.php" id="lecturer" class="record_delete">
                            <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm"/>
                                <input type="hidden" name="crs_id" value="<?php echo $row['crs_id']; ?>"/>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php
            }
            echo "</table>";
        } else {
            ?>
                <table class="table">
                    <tr>
                        <td>There are no records in table 'lecturer'.</td>
                    </tr>
            <?php
        }
        ?>
    </div>
</div>
</body>
<?php include_once('../../confirm_resubmission.php') ?>
</html>