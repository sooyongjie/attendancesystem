<?php

include_once('../../db_connect.php');

$sub_id = $_POST['sub_id'];

$query = "DELETE FROM `subject` WHERE sub_id = '".$sub_id."' ";

if ($db->query($query) === TRUE) {
    echo "Record deleted successfully";
    header( "refresh:1;url=subjects.php" );
} else {
    echo "Error: " . $query . "<br>" . $db->error;
}

?>