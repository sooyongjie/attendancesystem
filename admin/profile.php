<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('../header.php') ?>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Admin</title>
</head>
<body>

<?php
    session_start();
?>

<div class="container-form">
    <div class="navbar">
        <div class="back" onclick="window.location.href='main.php'";>
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </div>
        <div class="profile" onclick="window.location.href='#";>
            <span><?php echo $_SESSION['admin_username'] ?></span>
            <i class="fas fa-user-circle"></i>
        </div>
    </div>
    <div class="card card-body">
        <?php
        include_once("../title.php");
        include_once("../db_connect.php");

        $query = 
        "SELECT * FROM tbl_admin
        WHERE admin_id = '".$_SESSION['admin_id']."' ";

        $result = $db->query($query);

        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            ?>
            <div class="form-profile">
                <form action="validate_update_admin.php" method="post" class="form-profile">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $row['admin_username'] ?>"><br>
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $row['admin_password'] ?>" id="password1"><br>
                    <label>Confirm Password</label>
                    <input type="password" name="confirmpassword" class="form-control"><br>
                    <button type="submit"value="Submit" class="btn btn-secondary">Submit</button>
                </form>
            </div>
            
            <?php
        }
        else
        {
            echo "Error: " . $query . "<br>" . $db->error;
        }
        ?>
    </div>
</div>
</body>
</html>
    