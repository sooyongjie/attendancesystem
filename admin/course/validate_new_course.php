<?php

include_once('../../db_connect.php');

$crs_id = $_POST['crs_id'];
$crs_name = $_POST['crs_name'];

/* Check if course exists */
$query = "SELECT * FROM course";
$result = $db->query($query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc())
    {
        if($row['crs_name'] == $crs_name)
        {
            echo "The course was already created.";
            header( "refresh:2;url=course_new.php" );
        }
    }
}
else
{
    /* Insert */
    $query = "INSERT INTO class (class_venue, class_day, class_start, class_end, sub_id, sess_id, sect_id)
    VALUES ('$venue', '$day', '$start', '$end', '$sub_id', '$sess_id', '$sect_id')";
    if ($db->query($query) === TRUE) {
        echo "New record created successfully";
        header( "refresh:1;url=classes.php" );
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
    }
}


?>