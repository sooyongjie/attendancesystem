<?php

include_once('../../db_connect.php');

$crs_id = $_POST['crs_id'];

$query = "DELETE FROM course WHERE crs_id = '$crs_id' ";

if ($db->query($query) === TRUE) {
    echo "Record deleted successfully";
    header( "refresh:1;url=courses.php" );
} else {
    echo "Error: " . $query . "<br>" . $db->error;
}

?>