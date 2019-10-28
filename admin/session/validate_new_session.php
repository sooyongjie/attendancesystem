<?php

include_once('../../db_connect.php');

$name = $_POST['sess_name'];
$year = $_POST['sess_year'];

/* Insert */
$query = "INSERT INTO `session` (sess_name, sess_year)
VALUES ('$name', '$year')";

if ($db->query($query) === TRUE) {
    echo "New session created successfully";
    header( "refresh:1;url=sessions.php" );
} else {
    echo "Error: " . $query . "<br>" . $db->error;
}

?>