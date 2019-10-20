<?php
/**
 * Counts the number of items in the provided array.
 *
 * @param $stud_id Student ID
 *
 **/

function checkNotificationTable($stud_id, $lect_id, $sub_id, $class_id, $type)
{
    include("../db_connect.php");
    
    $query = 
    "SELECT * FROM notification
    WHERE class_id = '$class_id' AND stud_id = '$stud_id' ";

    $result = $db->query($query);   
    if ($result->num_rows > 0)
    {             
        while($row = $result->fetch_assoc())
        {
            echo " (Exists)";
        }
    }
    else 
    {
        echo " (Do not exists)";
        sendNotification($stud_id, $lect_id, $sub_id, $class_id, $type);
    }
            
}

function sendNotification($stud_id, $lect_id, $sub_id, $class_id, $notif_type)
{
    if($notif_type = "1")
    {
        $notif_title = "Warning #1";
        $notif_body = "First warning letter issued.";
    }
    else if($notif_type = "2")
    {
        $notif_title = "Warning #2";
        $notif_body = "Second warning letter issued.";
    }
    
    include("../db_connect.php");

    $query = 
    "INSERT INTO `notification` (notif_type, notif_title, notif_body, stud_id, lect_id, sub_id, class_id) 
    VALUES ('$notif_type', '$notif_title', '$notif_body', '$stud_id', '$lect_id', '$sub_id', '$class_id') ";

    if ($db->query($query) === TRUE) {
        echo "Notification Created";
        // header( "refresh:1;url=lecturers.php" );
    } else {
        echo "Error: " . $query . "<br>" . $db->error;
    }
}

?>