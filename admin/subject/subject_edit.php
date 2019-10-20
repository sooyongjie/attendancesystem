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
    <div class="back" onclick="window.location.href='subjects.php'";>
        <i class="fas fa-arrow-left" ></i>
        <span class="welcome-admin">Back</span>
    </div>
    <div class="card card-body">
        <?php
        if(!isset($_SESSION['sub_id']))
        {
            $_SESSION['sub_id'] = $_POST['sub_id'];
        }
        
        include_once('../../db_connect.php');

        $query = "SELECT * FROM `subject` 
        INNER JOIN course on `subject`.crs_id = course.crs_id
        INNER JOIN lecturer on `subject`.lect_id = lecturer.lect_id
        WHERE sub_id = '". $_SESSION['sub_id'] ."'";
        $result = $db->query($query);
        
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc())
            {
                ?>
                <form action="validate_update_subject.php" method="post" id="editlecturer">
                    <label>Subject ID</label>
                    <input type="text" name="sub_id" class="form-control" value="<?php echo $row['sub_id']; ?>" readonly><br>
                    <label>Subject Name</label>
                    <input type="text" name="sub_name" class="form-control" value="<?php echo $row['sub_name']; ?>"><br>
                    <label>Course Name</label>
                    <select class="form-control" name="crs_id">
                    <?php
                    $query2 = "SELECT * FROM course";
                    $result2 = $db->query($query2);
                    if ($result2->num_rows > 0)
                    {
                        while($row2 = $result2->fetch_assoc())
                        {
                            if($row['crs_id']==$row2['crs_id'])
                            {
                                echo "<option value='".$row2['crs_id']."' selected>".$row2['crs_name']."</option>";
                            }
                            else
                            {
                                echo "<option value='".$row2['crs_id']."'>".$row2['crs_name']."</option>";
                            }
                        }
                    }
                    ?>
                    </select><br>
                    <label>Lecturer Name</label>
                    <select class="form-control" name="lect_id">
                        <?php
                        include_once('../../db_connect.php');
                        $query2 = "SELECT * FROM lecturer";
                        $result2 = $db->query($query2);
                        if ($result2->num_rows > 0)
                        {
                            while($row2 = $result2->fetch_assoc())
                            {
                                if($row['lect_id']==$row2['lect_id'])
                                {
                                    echo "<option value='".$row2['lect_id']."' selected>".$row2['lect_name']."</option>";
                                }
                                else
                                {
                                    echo "<option value='".$row2['lect_id']."'>".$row2['lect_name']."</option>";
                                }
                            }
                        }
                        ?>
                    </select><br>
                    <button type="submit" form="editlecturer" value="Submit" class="btn btn-secondary">Update</button>
                </form>
                <?php
            }
        }
        else echo "Wadafak";

        ?>
    </div>
</div>
</body>
<?php include_once('../../confirm_resubmission.php') ?>
</html>
