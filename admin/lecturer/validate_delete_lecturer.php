<?php

include_once('../../db_connect.php');

$id = $_POST['id'];

$query = "DELETE FROM lecturer WHERE lect_id = '".$id."' ";

if ($db->query($query) === TRUE) {
    echo "Record deleted successfully";
    header( "refresh:1;url=lecturers.php" );
} else {
    echo "Error: " . $query . "<br>" . $db->error;
}

?>