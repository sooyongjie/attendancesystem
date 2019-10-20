<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('../header.php') ?>
    <link rel="stylesheet" href="../css/style.css">
    <title>Lecturer Page</title>
</head>
<body>

<?php
    session_start();
?>

<div class="container-form">
    <div class="back" onclick="window.location.href='main.php'";>
        <i class="fas fa-arrow-left" ></i>
        <span class="welcome-admin">Back</span>
    </div>
    <div class="card card-body">
        <?php

        if(!isset($_SESSION['sub_name']))
        {
            $_SESSION['sub_name'] = $_POST['name'];
        }

        ?>

        <h5 class="card-heading"><?php echo $_SESSION['sub_name'] ?></h5>

        <?php

        include_once("../db_connect.php");
        
        $query = "SELECT * FROM class WHERE sub_name = '".$_SESSION['sub_name']."' ";
        $result = $db->query($query);
        
        if ($result->num_rows > 0) {
            ?>
            <table class="table">
                <tr>
                    <th>Session</th>
                    <th>Section</th>
                    <th>Start</th>
                    <th>End</th>
                </tr>
            <?php
            while($row = $result->fetch_assoc())
            {
                ?>
                <tr>
                    <form method="post" action="lecturer_edit.php" id="lecturer" class="record_edit">
                        <td><?php echo $row['sess_name']; ?></td>
                        <td><?php echo $row['sect_name']; ?></td>
                        <td><?php echo $row['class_start']; ?></td>
                        <td><?php echo $row['class_end']; ?></td>
                        <input type="hidden" name="id" value="<?php echo $row['class_id']; ?>"/>
                    </form>
                </tr>
                
                <?php
            }
            echo "</table>";
        } else {
            ?>
                <hr><p>There is no class for the subject.</p>
            <?php
        }
        

        ?>
        
    </div>
</div>
</body>
<?php include_once('../confirm_resubmission.php') ?>
</html>