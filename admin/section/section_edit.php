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
        <div class="back" onclick="window.location.href='sections.php'";>
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </div>
        <div class="profile" onclick="window.location.href='profile.php'";>
            <span><?php echo $_SESSION["admin_username"] ?></span>
            <i class="fas fa-user-circle"></i>
        </div>
    </div>
    <div class="card card-body">
        <h5 class="card-heading">View Section</h5>
        <?php
        if(!isset($_SESSION['sect_id']))
        {
            $_SESSION['sect_id'] = $_POST['sect_id'];
        }
        include_once('../../db_connect.php');
        $query = "SELECT * FROM section
                INNER JOIN `session` on section.sess_id = `session`.sess_id
                INNER JOIN course on section.crs_id = course.crs_id 
                WHERE sect_id = '". $_SESSION['sect_id'] ."'";
        $result = $db->query($query);
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                ?>
                <form action="validate_update_section.php" method="post" id="editlecturer">
                    <label>Section ID</label>
                    <input type="text" name="sect_id" class="form-control" value="<?php echo $row['sect_id']; ?>" readonly><br>
                    <label>Section Name</label>
                    <input type="text" name="sect_name" class="form-control" value="<?php echo $row['sect_name']; ?>"><br>
                    <label>Course</label>
                    <select name="crs_id" class="form-control">
                    <?php 
                    $query2 = "SELECT crs_id, crs_name FROM course";
                    $result2 = $db->query($query2);
                    if ($result2->num_rows > 0)
                    {
                        while($row2 = $result2->fetch_assoc())
                        {
                            ?><option value="<?php echo $row2['crs_id'] ?>"><?php echo $row2['crs_name'] ?></option><?php
                        }
                    }
                    ?>
                    </select><br>
                    <label>Session</label>
                    <select name="sess_id" class="form-control">
                    <?php 
                    $query3 = "SELECT sess_id, sess_name, sess_year FROM `session`";
                    $result3 = $db->query($query3);
                    if ($result3->num_rows > 0)
                    {
                        while($row3 = $result3->fetch_assoc())
                        {
                            ?><option value="<?php echo $row3['sess_id']." - ".$row3['sess_year'] ?>"><?php echo $row3['sess_name'] ?></option><?php
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
