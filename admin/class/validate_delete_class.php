<?php

include_once('../../db_connect.php');

$class_id = $_POST['class_id'];

$query = "DELETE FROM class WHERE class_id = '$class_id' ";

if ($db->query($query) === TRUE) {
    echo "Record deleted successfully";
    header( "refresh:1;url=classes.php" );
} else {
    echo "Error: " . $query . "<br>" . $db->error;
}

?>