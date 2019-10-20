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
        <h5 class="card-heading">Classes</h5>
        <button type="button" class="btn btn-light btn-sm btn-block" onclick="location.href='class_new.php';">
            <i class="fas fa-plus"></i>
            <span>Add class</span>
        </button>
        <button type="button" class="btn btn-light btn-sm btn-block add" onclick="location.href='';">
            <i class="fas fa-user-plus"></i>
            <span>Enroll Student (WIP)</span>
        </button>
        <?php
        unset($_SESSION['class_id']);
        include_once('../../db_connect.php');
        $query = "SELECT * FROM class
                INNER JOIN `subject` on class.sub_id = `subject`.sub_id 
                ORDER BY class_day, class_venue";
        $result = $db->query($query);
        if ($result->num_rows > 0)
        {
            ?>
            <table class="table">
                <tr>
                    <th>Class Venue</th>
                    <th>Subject</th>
                    <th>Class Day</th>
                    <th>Action</th>
                </tr>
            <?php
            while($row = $result->fetch_assoc())
            {
                ?>
                <tr>
                    <td> <?php echo $row["class_venue"]; ?> </td>
                    <td> <?php echo $row["sub_name"]; ?> </td>
                    <td> <?php echo $row["class_day"]; ?> </td>
                    <td>
                        <div class="record-actions">
                            <form method="post" action="class_edit.php" id="lecturer" class="record_edit">
                                <input type="submit" name="edit" value="View" class="btn btn-secondary btn-sm"/>
                                <input type="hidden" name="class_id" value="<?php echo $row['class_id']; ?>"/>
                            </form>
                            <form method="post" action="validate_delete_class.php" id="lecturer" class="record_delete">
                            <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm"/>
                                <input type="hidden" name="class_id" value="<?php echo $row['class_id']; ?>"/>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
            </table>
            <?php
        }
        else
        {
            ?>
            <table class="table">
                <tr>
                    <td>There are no records in table 'lecturer'.</td>
                </tr>
            </table>
            <?php
        }
        ?>
    </div>
</div>
</body>
<?php include_once('../../confirm_resubmission.php') ?>
</html>