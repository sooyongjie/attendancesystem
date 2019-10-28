<?php

include_once('../../db_connect.php');

$sub_id = $_POST['sub_id'];
$sect_id = $_POST['sect_id'];
$class_id = $_POST['class_id'];

$query = "UPDATE class_enrollment SET sub_id='".$sub_id."', sect_id='".$sect_id."', class_id='".$class_id."' 
WHERE ce_id='".$_POST['ce_id']."' ";

$result = mysqli_query($db,$query);

if ($db->query($query) === TRUE) {
    echo "Record updated successfully";
    header( "refresh:0;url=enrollments.php" );
} else {
    echo "Error updating record: " . $db->error;
}

?>