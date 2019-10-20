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
    <div class="back" onclick="window.location.href='../main.php'";>
        <i class="fas fa-arrow-left" ></i>
        <span class="welcome-admin">Back</span>
    </div>
    <div class="card card-body">
    <?php include_once("../../title.php"); ?>
        <h5 class="card-heading">Lecturers</h5>
        <button type="button" class="btn btn-light btn-sm btn-block add" onclick="location.href='lecturer_new.php';">
        <i class="fas fa-plus"></i>
        <span>Add lecturer</span>
        </button>
        <?php
        include_once('../../db_connect.php');
        $query = "SELECT * FROM lecturer";
        $result = $db->query($query);
        if ($result->num_rows > 0)
        {
            ?>
                <table class="table">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
            <?php
            while($row = $result->fetch_assoc())
            {
                ?>
                <tr>
                    <td> <?php echo $row["lect_name"]; ?> </td>
                    <td> <?php echo $row["lect_email"]; ?> </td>
                    <td>
                        <div class="record-actions">
                            <form method="post" action="lecturer_edit.php" id="lecturer" class="record_edit">
                                <input type="submit" name="edit" value="Edit" class="btn btn-secondary btn-sm"/>
                                <input type="hidden" name="id" value="<?php echo $row['lect_id']; ?>"/>
                            </form>
                            <form method="post" action="validate_delete_lecturer.php" id="lecturer" class="record_delete">
                            <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm"/>
                                <input type="hidden" name="id" value="<?php echo $row['lect_id']; ?>"/>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php
            }
            echo "</table>";
        } else {
            ?>
                <table class="table">
                    <tr>
                        <td>There are no records in table 'lecturer'.</td>
                    </tr>
            <?php
        }
        
        unset($_SESSION['id']);
        
        ?>
    </div>
</div>
</body>
<?php include_once('../../confirm_resubmission.php') ?>
</html>