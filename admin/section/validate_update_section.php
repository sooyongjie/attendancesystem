<?php

include_once('../../db_connect.php');

$sect_id = $_POST['sect_id'];
$sect_name = $_POST['sect_name'];
$crs_id = $_POST['crs_id'];
$sess_id = $_POST['sess_id'];

$query = 
"UPDATE `section` 
SET sect_name= '$sect_name', crs_id='$crs_id', sess_id='$sess_id'  
WHERE sect_id='$sect_id' ";

$result = mysqli_query($db,$query);

if ($db->query($query) === TRUE) {
    echo "Section updated successfully";
    header( "refresh:0;url=sections.php" );
} else {
    echo "Error updating record: " . $db->error;
}
?>