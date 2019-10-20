<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('../../header.php') ?>
    <link rel="stylesheet" href="../../css/style.css">
    <title>Admin Page</title>
</head>
<body>

<?php
    session_start();
?>

<div class="container-form">
    <div class="back" onclick="window.location.href='lecturers.php'";>
        <i class="fas fa-arrow-left" ></i>
        <span class="welcome-admin">Back</span>
    </div>
    <div class="card card-body">
    <form action="validate_new_lecturer.php" method="post" id="newlecturer">
        <label>Lecturer Name</label>
        <input type="text" name="name" class="form-control" autocomplete="off"><br>
        <label>Lecturer Email</label>
        <input type="text" name="email" class="form-control" autocomplete="off"><br>
        <label>Lecturer password</label>
        <input type="password" name="password" class="form-control" autocomplete="new-password"><br>
        <button type="submit" form="newlecturer" value="Submit" class="btn btn-secondary">Submit</button>
    </form>

    </div>
</div>
</body>
<?php include_once('../../confirm_resubmission.php') ?>
</html>
