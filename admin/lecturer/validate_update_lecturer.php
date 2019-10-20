<?php

include_once("../../db_connect.php");

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$query = "UPDATE lecturer SET lect_name='".$name."', lect_email='".$email."', lect_password='".$password."' 
WHERE lect_id='".$id."' ";

$result = mysqli_query($db,$query);

if ($db->query($query) === TRUE) {
    echo "Record updated successfully";
    header( "refresh:1;url=lecturers.php" );
} else {
    echo "Error updating record: " . $db->error;
}

?>