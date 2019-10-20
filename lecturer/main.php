<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('../header.php') ?>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/lecturer.css">
    <title>Lecturer Page</title>
</head>
<body>

<?php
    session_start();
?>

<div class="container-form">
    <div class="navbar">
        <div class="back" onclick="window.location.href='../index.html'";>
            <i class="fas fa-arrow-left" ></i>
            <span class="welcome-admin">Back</span>
        </div>
        <div class="profile" onclick="window.location.href='profile.php'";>
            <span><?php echo $_SESSION['lect_name'] ?></span>
            <i class="fas fa-user-circle"></i>
        </div>
    </div>
    <div class="card card-body">
        <?php
        include_once("../title.php");
        include_once("../db_connect.php");
        unset($_SESSION['sub_id']);
        ?>
        <h5 class="card-heading"><i class="fas fa-pen-alt heading-icon"></i>Subjects</h5>
        <?php
        $query = "SELECT * FROM `subject` WHERE lect_id = '".$_SESSION['lect_id']."'";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc())
            {
                ?>
                <form method="post" action="classes-from-subject.php" id="lecturer" class="record_edit">
                    <input type="submit" name="edit" value="<?php echo $row['sub_name']; ?>" class="btn btn-light btn-block"/>
                    <br>
                    <input type="hidden" name="id" value="<?php echo $row['sub_id']; ?>"/>
                </form>
                <?php
            }
        } else {
            ?>
                <p>No subjects are taught by you.</p>
            <?php
        }
        ?>
        <h5 class="card-heading"><i class="far fa-clipboard heading-icon"></i>View Attendance</h5>
        <button class="btn btn-light btn-block" onclick="window.location.href='attendance_subject_list.php'">View Attendance</button>
    </div>
</div>

</body>
</html>