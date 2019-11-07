<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('../header.php') ?>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Admin Page</title>
</head>
<body>

<?php
    session_start();
?>

<div class="container-form">
    <div class="navbar">
        <div class="back" onclick="window.location.href='../index.html'";>
        </div>
        <div class="profile" onclick="window.location.href='profile.php'";>
            <span><?php echo $_SESSION["admin_username"] ?></span>
            <i class="fas fa-user-circle"></i>
        </div>
    </div>
    <div class="card card-body">
        <?php include_once("../title.php") ?>
        <h5>Main</h5><br>
        <button type="button" class="btn btn-light btn-sm btn-block btn-admin" onclick="location.href='lecturer/lecturers.php';">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Lecturers</span>
        </button>
        <button type="button" class="btn btn-light btn-sm btn-block btn-admin" onclick="location.href='student/students.php';">
            <i class="fas fa-user-friends"></i>
            <span>Students</span>
        </button>
        <button type="button" class="btn btn-light btn-sm btn-block btn-admin" onclick="location.href='subject/subjects.php';">
            <i class="fas fa-pen-alt"></i>
            <span>Subjects</span>
        </button>
        <button type="button" class="btn btn-light btn-sm btn-block btn-admin" onclick="location.href='class/classes.php';">
            <i class="fas fa-door-closed"></i>
            <span>Class</span>
        </button>
        <br><h5>Others (WIP)</h5><br>
        <button type="button" class="btn btn-light btn-sm btn-block btn-admin" onclick="location.href='course/courses.php';">
            <i class="fas fa-circle-notch"></i>
            <span>Course</span>
        </button>
        <button type="button" class="btn btn-light btn-sm btn-block btn-admin" onclick="location.href='section/sections.php';">
            <i class="fas fa-circle-notch"></i>
            <span>Section</span>
        </button>
        <button type="button" class="btn btn-light btn-sm btn-block btn-admin" onclick="location.href='session/sessions.php';">
            <i class="fas fa-circle-notch"></i>
            <span>Session</span>
        </button>
        </div>
    </div>
</div>

</body>
<script>

</script>
</html>