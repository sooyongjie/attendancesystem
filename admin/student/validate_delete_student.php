<?php

include_once('../../db_connect.php');

$stud_id = $_POST['stud_id'];

$query = "DELETE FROM student WHERE stud_id = '".$stud_id."' ";

if ($db->query($query) === TRUE) {
    echo "Record deleted successfully";
    header( "refresh:1;url=students.php" );
} else {
    echo "Error: " . $query . "<br>" . $db->error;
}

?>