<?php

include_once('../../db_connect.php');

$name = $_POST['sess_name'];
$year = $_POST['sess_year'];

$query = 
"UPDATE `session` 
SET sess_name = '$name', sess_year='$year' 
WHERE sess_id = '".$_POST['sess_id']."' ";

$result = mysqli_query($db,$query);

if ($db->query($query) === TRUE) {
    echo "Record updated successfully";
    header( "refresh:1;url=classes.php" );
} else {
    echo "Error updating record: " . $db->error;
}

?>