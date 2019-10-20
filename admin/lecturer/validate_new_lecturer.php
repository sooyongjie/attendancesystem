<?php

include_once('../../db_connect.php');

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$query = "INSERT INTO lecturer (lect_name, lect_email, lect_password)
VALUES ('".$name."', '".$email."', '".$password."')";

if ($db->query($query) === TRUE) {
    echo "New record created successfully";
    header( "refresh:1;url=lecturers.php" );
} else {
    echo "Error: " . $query . "<br>" . $db->error;
}

?>