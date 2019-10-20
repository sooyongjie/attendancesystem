<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('../header.php') ?>
    <link rel="stylesheet" href="../css/style.css">
    <title>Login</title>
</head>
<body>
    <div class="container-form">
        <div class="card card-body">
            <h4 class="form-heading">Lecturer Login</h4>
            <form action="validate_lecturer.php" method="post" id="lecturer" class="lecturer">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="lecturer1"><br>
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="lecturer1"><br>
                <button type="submit" form="lecturer" value="Submit" class="btn btn-secondary">Login</button>
            </form>
        </div>
    </div>
</body>
</html>