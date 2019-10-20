<?php

include_once('../../db_connect.php');

$sub_name = $_POST['sub_name'];
$crs_id = $_POST['crs_id'];
$lect_id = $_POST['lect_id'];

$query = "INSERT INTO `subject` (sub_name, crs_id, lect_id)
VALUES ('".$sub_name."', '".$crs_id."', '".$lect_id."')";

if ($db->query($query) === TRUE) {
    echo "New record created successfully";
    header( "refresh:1;url=subjects.php" );
} else {
    echo "Error: " . $query . "<br>" . $db->error;
}

// $query = "INSERT INTO lecturer (lect_name, lect_email, lect_password)
// VALUES ('".$name."', '".$email."', '".$password."')";

// if ($db->query($query) === TRUE) {
//     echo "New record created successfully";
//     header( "refresh:1;url=lecturers.php" );
// } else {
//     echo "Error: " . $query . "<br>" . $db->error;
// }

?>