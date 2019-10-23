<?php

include_once('../../db_connect.php');

$sect_name = $_POST['sect_name'];
$crs_id = $_POST['crs_id'];
$sess_id = $_POST['sess_id'];

/* Insert */
$query = "INSERT INTO section (sect_name, crs_id, sess_id)
VALUES ('$sect_name', '$crs_id', '$sess_id')";

if ($db->query($query) === TRUE) {
    echo "New record created successfully";
    header( "refresh:0;url=sections.php" );
} else {
    echo "Error: " . $query . "<br>" . $db->error;
}

?>