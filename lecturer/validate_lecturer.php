<?php
session_start();
?>
<?php

include_once("../db_connect.php");

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM lecturer WHERE lect_username = '". $username ."' AND lect_password = '". $password ."'";
$result = $db->query($query);

if ($result->num_rows > 0)
{
    $row = $result->fetch_assoc();
    $_SESSION["lect_name"] = $row["lect_name"];
    $_SESSION["lect_id"] = $row["lect_id"];
    $_SESSION["lect_logged"] = $row["lect_id"];

    header("Location: main.php"); 
    exit();
}
else echo "Please try again."; //Fail

?>