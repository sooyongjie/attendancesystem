<?php

include_once('../../db_connect.php');

$class_id = $_POST['class_id'];
$venue = $_POST['class_venue'];
$day = $_POST['class_day'];
$start = $_POST['class_start'];
$end = $_POST['class_end'];
$sub_id = $_POST['sub_id'];
$sess_id = $_POST['sess_id'];
$sect_id = $_POST['sect_id'];

$query = 
"UPDATE class 
SET class_venue= '$venue', class_day='$day', class_start='$start', class_end='$end', sub_id = '$sub_id', sess_id = '$sess_id', sect_id = '$sect_id' 
WHERE class_id='$class_id' ";

$result = mysqli_query($db,$query);

if ($db->query($query) === TRUE) {
    echo "Record updated successfully";
    header( "refresh:1;url=classes.php" );
} else {
    echo "Error updating record: " . $db->error;
}

?>