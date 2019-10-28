<?php

include_once('../../db_connect.php');

$stud_id = $_POST['stud_id'];
$sub_id = $_POST['sub_id'];
$sect_id = $_POST['sect_id'];
$class_id = $_POST['class_id'];

$query = "INSERT INTO class_enrollment (stud_id, sub_id, sect_id, class_id)
VALUES ('$stud_id', '$sub_id', '$sect_id', '$class_id')";

if ($db->query($query) === TRUE) {
    echo "New record created successfully";
    header( "refresh:0;url=students.php" );
} else {
    echo "Error: " . $query . "<br>" . $db->error;
}

?>