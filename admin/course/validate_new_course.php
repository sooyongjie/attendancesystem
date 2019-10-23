<?php

include_once('../../db_connect.php');

$crs_name = $_POST['crs_name'];

/* Insert */
$query = "INSERT INTO course (crs_name) VALUES ('$crs_name')";
if ($db->query($query) === TRUE)
{
    header( "refresh:0;url=courses.php" );
}
else
{
    echo "Error: " . $query . "<br>" . $db->error;
}



?>