<?php

include_once('../../db_connect.php');

$crs_name = $_POST['crs_name'];

/* Check if course exists */
$query = "SELECT * FROM course";
$result = $db->query($query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc())
    {
        if($row['crs_name'] = $crs_name)
        {
            echo "The course was already created.";
            header( "refresh:2;url=course_new.php" );
            exit();
        }
    }
}
/* Insert */
$query = "INSERT INTO course (crs_name) VALUES ('$crs_name')";
if ($db->query($query) === TRUE)
{
    echo "New course created successfully";
    header( "refresh:1;url=courses.php" );
}
else
{
    echo "Error: " . $query . "<br>" . $db->error;
}



?>