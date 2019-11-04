<?php
session_start();
?>
<?php

include_once("../db_connect.php");

$username = $_POST['username'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];

if($password != $confirmpassword)
{
    echo "Password do not match.";
    header( "refresh:0;url=profile.php" );
    exit();
}

$query = 
"UPDATE lecturer SET lect_password = '$password', lect_username = '$username' 
WHERE lect_id = '".$_SESSION['lect_id']."'";

$result = mysqli_query($db,$query);

if ($db->query($query) === TRUE) {
    echo "Account updated successfully.";
    header( "refresh:1;url=profile.php" );
} else {
    echo "Error updating record: " . $db->error;
}

?>