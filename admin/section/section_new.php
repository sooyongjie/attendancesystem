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
        <h5 class="card-heading">New Section</h5>
        <?php
        include_once('../../db_connect.php');
        ?>
        <form action="validate_new_section.php" method="post" id="editlecturer">
            <label>Section Name</label>
            <input type="text" name="sect_name" class="form-control"><br>
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
                        ?><option value="<?php echo $row3['sess_id']?>"><?php echo $row3['sess_name'] ?></option><?php
                    }
                }
                ?>
            </select><br>
            <button type="submit" form="editlecturer" value="Submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>
</div>
</body>
<?php include_once('../../confirm_resubmission.php') ?>
</html>
