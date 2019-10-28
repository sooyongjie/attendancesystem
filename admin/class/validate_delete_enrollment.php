<?php

include_once('../../db_connect.php');

$ce_id = $_POST['ce_id'];

$query = "DELETE FROM class_enrollment WHERE ce_id = '$ce_id' ";

if ($db->query($query) === TRUE) {
    echo "Record deleted successfully";
    header( "refresh:0;url=enrollments.php" );
} else {
    echo "Error: " . $query . "<br>" . $db->error;
}

?>