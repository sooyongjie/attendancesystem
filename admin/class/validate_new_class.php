<?php

include_once('../../db_connect.php');

$venue = $_POST['class_venue'];
$day = $_POST['class_day'];
$start = $_POST['class_start'];
$end = $_POST['class_end'];
$sub_id = $_POST['sub_id'];
$sess_id = $_POST['sess_id'];
$sect_id = $_POST['sect_id'];

/* Check if clash exists */
$query = "SELECT * FROM class";
$result = $db->query($query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc())
    {
        if($row['class_venue'] == $venue && $row['class_day'] == $day && $row['class_start'] == $start)
        {
            echo "There is a clash with a class that starts at ".$row['class_start']." and ends at ".$row['class_end'].". Redirecting in 3 seconds.";
            header( "refresh:3;url=class_new.php" );
            exit();
        }
    }
}

/* Insert */
$query = "INSERT INTO class (class_venue, class_day, class_start, class_end, sub_id, sess_id, sect_id)
VALUES ('$venue', '$day', '$start', '$end', '$sub_id', '$sess_id', '$sect_id')";

if ($db->query($query) === TRUE) {
    echo "New record created successfully";
    header( "refresh:1;url=classes.php" );
} else {
    echo "Error: " . $query . "<br>" . $db->error;
}

?>