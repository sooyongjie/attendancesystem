<?php

include_once('../../db_connect.php');

$sect_id = $_POST['sect_id'];

$query = "DELETE FROM section WHERE sect_id = '$sect_id' ";

if ($db->query($query) === TRUE) {
    header( "refresh:0;url=sections.php" );
} else {
    echo "Error: " . $query . "<br>" . $db->error;
}

?>