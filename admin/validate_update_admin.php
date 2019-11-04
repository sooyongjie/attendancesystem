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
"UPDATE tbl_admin SET admin_password = '$password', admin_username = '$username' 
WHERE admin_id = '".$_SESSION['admin_id']."'";

$result = mysqli_query($db,$query);

if ($db->query($query) === TRUE) {
    echo "Account updated successfully.";
    header( "refresh:1;url=profile.php" );
} else {
    echo "Error updating record: " . $db->error;
}

?>