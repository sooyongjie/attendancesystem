<?php

include_once("../db_connect.php");

$att_id = $_POST['att_id'];
$att_status = $_POST['att_status'];

$query = 
"UPDATE attendance SET att_status = '$att_status' 
WHERE att_id = '$att_id'";

$result = mysqli_query($db,$query);

if ($db->query($query) === TRUE) {
    echo "Record updated successfully.";
    header( "refresh:1;url=attendance_view_by_subject.php" );
} else {
    echo "Error updating record: " . $db->error;
}

?>