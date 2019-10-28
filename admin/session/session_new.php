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
        <h5 class="card-heading">New Session</h5>
        <form action="validate_new_session.php" method="post">
            <label>Session Name</label>
            <input type="text" name="sess_name" class="form-control" placeholder="Example: July 2020"><br>
            <label>Session Year</label>
            <select name="sess_year" class="form-control">
                <option value="<?php echo date("Y") ?>"><?php echo date("Y"); ?></option>
                <option value="<?php echo date("Y")+1 ?>"><?php echo date("Y")+1; ?></option>
                <option value="<?php echo date("Y")+1 ?>"><?php echo date("Y")+2; ?></option>
            </select><br>
            <button type="submit" value="Submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>
</div>
</body>
<?php include_once('../../confirm_resubmission.php') ?>
</html>
