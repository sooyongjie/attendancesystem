<?php
session_start();
?>
<?php

include_once("../db_connect.php");

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM student WHERE stud_username = '". $username ."' AND stud_password = '". $password ."'";
$result = $db->query($query);

if ($result->num_rows > 0)
{
    $row = $result->fetch_assoc();
    $_SESSION["stud_id"] = $row["stud_id"];
    $_SESSION["stud_name"] = $row["stud_name"];

    header("Location: main.php"); 
    exit();
}
else
{
    echo "Please try again.";
    header( "refresh:1;url=../index.html" );
}

?>