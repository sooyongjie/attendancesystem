<?php

include_once("../../db_connect.php");

$sub_id = $_POST['sub_id'];
$sub_name = $_POST['sub_name'];
$crs_id = $_POST['crs_id'];
$lect_id = $_POST['lect_id'];

$query = "UPDATE `subject` SET sub_name='".$sub_name."', crs_id='".$crs_id."', lect_id='".$lect_id."' 
WHERE sub_id='".$sub_id."' ";

$result = mysqli_query($db,$query);

if ($db->query($query) === TRUE) {
    echo "Record updated successfully";
    header( "refresh:1;url=subjects.php" );
} else {
    echo "Error updating record: " . $db->error;
}

?>