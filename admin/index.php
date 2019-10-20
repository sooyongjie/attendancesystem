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
            <h4 class="form-heading">Admin Login</h4>
            <form action="validate_admin.php" method="post" id="admin">
                <label>Username</label>
                <input type="text" name="username" class="form-control"><br>
                <label>Password</label>
                <input type="password" name="password" class="form-control"><br>
                <button type="submit" form="admin" value="Submit" class="btn btn-secondary">Login</button>
            </form>
        </div>
    </div>
</body>
</html>