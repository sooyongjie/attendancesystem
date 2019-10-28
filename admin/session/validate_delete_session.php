<?php

include_once('../../db_connect.php');

$sess_id = $_POST['sess_id'];

$query = "DELETE FROM `session` WHERE sess_id = '$sess_id' ";

if ($db->query($query) === TRUE) {
    echo "Session deleted successfully";
    header( "refresh:1;url=sessions.php" );
} else {
    echo "Error: " . $query . "<br>" . $db->error;
}

?>