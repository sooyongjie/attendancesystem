<?php

include_once('../../db_connect.php');

$name = $_POST['name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$query = "INSERT INTO student (stud_name, stud_email, stud_username, stud_password)
VALUES ('$name', '$email', '$username', '$password')";

if ($db->query($query) === TRUE) {
    echo "New record created successfully";
    header( "refresh:1;url=students.php" );
} else {
    echo "Error: " . $query . "<br>" . $db->error;
}

?>