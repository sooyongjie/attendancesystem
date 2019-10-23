<?php

include_once('../../db_connect.php');

$crs_id = $_POST['crs_id'];
$crs_name = $_POST['crs_name'];



/* Check if course exists */
$query = "SELECT * FROM course";
$result = $db->query($query);
if ($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        if($row['crs_name'] == $crs_name)
        {
            echo "The course was already created.";
            header( "refresh:2;url=course_new.php" );
            exit();
        }
    }
}
$query = "UPDATE course SET crs_name = '$crs_name' 
        WHERE crs_id='$crs_id'";
$result = mysqli_query($db,$query);
if ($db->query($query) === TRUE)
{
    echo "Record updated successfully";
    header("refresh:0;url=courses.php");
} 
else
{
    echo "Error updating record: " . $db->error;
}



?>