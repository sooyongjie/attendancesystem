<?php

include_once('../../db_connect.php');

$stud_id = $_POST['stud_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$query = "UPDATE student SET stud_name='".$name."', stud_email='".$email."', stud_username='".$username."', stud_password='".$password."' 
WHERE stud_id='".$stud_id."' ";

$result = mysqli_query($db,$query);

if ($db->query($query) === TRUE) {
    echo "Record updated successfully";
    header( "refresh:1;url=students.php" );
} else {
    echo "Error updating record: " . $db->error;
}

?>