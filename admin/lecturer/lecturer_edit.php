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
        <div class="back" onclick="window.location.href='lecturers.php'";>
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </div>
        <div class="profile" onclick="window.location.href='profile.php'";>
            <span><?php echo $_SESSION["admin_username"] ?></span>
            <i class="fas fa-user-circle"></i>
        </div>
    </div>
    <div class="card card-body">
        <h5 class="card-heading">View Lecturer</h5>
        <?php
        if(!isset($_SESSION['id']))
        {
            $_SESSION['id'] = $_POST['id'];
        }
        
        include_once('../../db_connect.php');

        $query = "SELECT * FROM lecturer WHERE lect_id = '". $_SESSION['id'] ."'";
        $result = $db->query($query);
        
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                ?>
                <form action="validate_update_lecturer.php" method="post" id="editlecturer">
                    <label>Lecturer ID</label>
                    <input type="text" name="id" class="form-control" value="<?php echo $row['lect_id']; ?>" readonly><br>
                    <label>Lecturer Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $row['lect_name']; ?>"><br>
                    <label>Lecturer Email</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $row['lect_email']; ?>"><br>
                    <label>Lecturer password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $row['lect_password']; ?>"><br>
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
