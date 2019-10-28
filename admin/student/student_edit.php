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
        <div class="back" onclick="window.location.href='students.php'";>
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </div>
        <div class="profile" onclick="window.location.href='profile.php'";>
            <span><?php echo $_SESSION["admin_username"] ?></span>
            <i class="fas fa-user-circle"></i>
        </div>
    </div>
    <div class="card card-body">
        <h5 class="card-heading">View Student</h5>
        <?php
        include_once('../../db_connect.php');

        if(!isset($_SESSION['stud_id']))
        {
            $_SESSION['stud_id'] = $_POST['stud_id'];
        }

        $query = "SELECT * FROM student WHERE stud_id = '". $_SESSION['stud_id'] ."'";
        $result = $db->query($query);
        
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                ?>
                <form action="validate_update_student.php" method="post" id="editstudent">
                    <label>student ID</label>
                    <input type="text" name="stud_id" class="form-control" value="<?php echo $row['stud_id']; ?>" readonly><br>
                    <label>Student Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $row['stud_name']; ?>"><br>
                    <label>Student Email</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $row['stud_email']; ?>"><br>
                    <label>Student Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $row['stud_username']; ?>" ><br>
                    <label>Student password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $row['stud_password']; ?>" autocomplete="new-password"><br>
                    <button type="submit" form="editstudent" value="Submit" class="btn btn-secondary">Update</button>
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
