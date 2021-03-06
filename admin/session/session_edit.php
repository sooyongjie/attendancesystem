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
        <div class="back" onclick="window.location.href='sessions.php'";>
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </div>
        <div class="profile" onclick="window.location.href='profile.php'";>
            <span><?php echo $_SESSION["admin_username"] ?></span>
            <i class="fas fa-user-circle"></i>
        </div>
    </div>
    <div class="card card-body">
        <h5 class="card-heading">View Session</h5>
        <?php
        if(!isset($_SESSION['sess_id']))
        {
            $_SESSION['sess_id'] = $_POST['sess_id'];
        }
        
        include_once('../../db_connect.php');

        $query = "SELECT * FROM `session`
                WHERE sess_id = '". $_SESSION['sess_id'] ."'";
        $result = $db->query($query);
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                ?>
                <form action="validate_update_session.php" method="post">
                    <label>Session ID</label>
                    <input type="text" name="sess_id" class="form-control" value="<?php echo $row['sess_id']; ?>" readonly><br>
                    <label>Session Name</label>
                    <input type="text" name="sess_name" class="form-control" value="<?php echo $row['sess_name']; ?>"><br>
                    <label>Session Year</label>
                    <input type="text" name="sess_year" class="form-control" value="<?php echo $row['sess_year']; ?>"><br>

                    <button type="submit" value="Submit" class="btn btn-secondary">Update</button>
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
