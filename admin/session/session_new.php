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
        <form action="validate_new_class.php" method="post" id="newclass">
            <label>Session Name</label>
            <input type="text" name="class_venue" class="form-control" placeholder="Example: July 2020"><br>
            <label>Session Year</label>
            <select name="sess_year" class="form-control">
                <option value="<?php echo date("Y") ?>"><?php echo date("Y"); ?></option>
                <option value="<?php echo date("Y") ?>"><?php echo date("Y") + 1; ?></option>
                <option value="<?php echo date("Y") ?>"><?php echo date("Y") + 2; ?></option>
            </select><br>
            <button type="submit" form="newclass" value="Submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>
</div>
</body>
<?php include_once('../../confirm_resubmission.php') ?>
</html>
