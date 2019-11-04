<?php
session_start();
?>
<?php

include_once("../db_connect.php");

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM tbl_admin WHERE admin_username = '". $username ."' AND admin_password = '". $password ."'";
$result = $db->query($query);

if ($result->num_rows > 0)
{
    $row = $result->fetch_assoc();
    $_SESSION["admin_username"] = $username;
    $_SESSION["admin_id"] = $row['admin_id'];
    header("Location: main.php"); 
    exit();
}
else
{
    echo "Please try again."; //Fail
}

// $result = mysqli_query($db,$query);
// if (mysqli_num_rows($result) == 1) 
// {
//     $_SESSION["admin_username"] = $username;
//     $_SESSION["admin_id"] = $row['admin_id'];
//     header("Location: main.php"); 
//     exit();
// } 
// else 
// {
//     echo "Please try again."; //Fail
// }

?>