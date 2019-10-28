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
        <div class="back" onclick="window.location.href='../main.php'";>
            <i class="fas fa-arrow-left"></i>
            <span>Back</span>
        </div>
        <div class="profile" onclick="window.location.href='../main.php'";>
            <span><?php echo $_SESSION["admin_username"] ?></span>
            <i class="fas fa-user-circle"></i>
        </div>
    </div>
    <div class="card card-body">
    <?php include_once("../title.php"); ?>
        <h5 class="card-heading">Sessions</h5>
        <button type="button" class="btn btn-light btn-sm btn-block add" onclick="location.href='session_new.php';">
            <i class="fas fa-plus"></i>
            <span>Add session</span>
        </button>
        <?php
        unset($_SESSION['sess_id']);
        include_once('../../db_connect.php');
        $query = "SELECT * FROM `session`
                ORDER BY sess_year";
        $result = $db->query($query);
        if ($result->num_rows > 0)
        {
            ?>
            <table class="table">
                <tr>
                    <th>Session Name</th>
                    <th>Session Year</th>
                    <th>Action</th>
                </tr>
            <?php
            while($row = $result->fetch_assoc())
            {
                ?>
                <tr>
                    <td> <?php echo $row["sess_name"]; ?> </td>
                    <td> <?php echo $row["sess_year"]; ?> </td>
                    <td>
                        <div class="record-actions">
                            <form method="post" action="session_edit.php" id="lecturer" class="record_edit">
                                <input type="submit" name="edit" value="View" class="btn btn-secondary btn-sm"/>
                                <input type="hidden" name="sess_id" value="<?php echo $row['sess_id']; ?>"/>
                            </form>
                            <form method="post" action="validate_delete_session.php" id="lecturer" class="record_delete">
                            <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm"/>
                                <input type="hidden" name="sess_id" value="<?php echo $row['sess_id']; ?>"/>
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