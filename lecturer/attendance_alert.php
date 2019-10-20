<?php

/* Count Student Total Absence */
$query = 
"SELECT * FROM attendance 
INNER JOIN `student` on attendance.stud_id = `student`.stud_id
WHERE sub_id = '$sub_id'
ORDER BY student.stud_name";
$result = $db->query($query);

if ($result->num_rows > 0)
{
    $absent = array();
    $stud_id = array();
    $i = 0;
    while($row = $result->fetch_assoc())
    {
        if(!isset($absent[$row['stud_name']]))  // if name doesn't exist in absent array
        {
            $absent[$row['stud_name']] = 0;
            $stud_id[$i] = $row['stud_id'];
            $i++;
        }
        if($row['att_status'] == 2) // if absent
        {
            $absent[$row['stud_name']]++;
        }
    }
}   
else
{
    echo "Error: " . $query . "<br>" . $db->error;
}

/*  */
$query = 
"SELECT DISTINCT(stud_name), attendance.stud_id, sub_id, class_id, lect_id
FROM attendance 
INNER JOIN `student` on attendance.stud_id = `student`.stud_id
WHERE sub_id = '$sub_id'
ORDER BY student.stud_name";

$result = $db->query($query);
if ($result->num_rows > 0)
{             
    while($row = $result->fetch_assoc())
    {
        if($absent[$row['stud_name']] == 4)
        {
            checkNotificationTable($row['stud_id'], $row['lect_id'], $row['sub_id'], $row['class_id'], 1);
        }
        if($absent[$row['stud_name']] == 5)
        {
            checkNotificationTable($row['stud_id'], $row['lect_id'], $row['sub_id'], $row['class_id'], 2);
        }
        if($absent[$row['stud_name']] == 8)
        {
            checkNotificationTable($row['stud_id'], $row['lect_id'], $row['sub_id'], $row['class_id'], 3);
        }
    }
}
else
{
    echo "Error: " . $query . "<br>" . $db->error;
}

/**
 * Checks Database whether the notification exists for the student
 *
 * @param $stud_id Student ID
 * @param $lect_id Lecturer ID
 * @param $sub_id Subject ID
 * @param $class_id Class ID
 * @param $type Type of Notification
 *
 **/

function checkNotificationTable($stud_id, $lect_id, $sub_id, $class_id, $type)
{
    include("../db_connect.php");
    
    $query = 
    "SELECT * FROM notification
    WHERE class_id = '$class_id' AND stud_id = '$stud_id' AND notif_type = '$type' ";

    $result = $db->query($query);   
    if ($result->num_rows > 0)
    {             
    }
    else 
    {
        sendNotification($stud_id, $lect_id, $sub_id, $class_id, $type);
    }
}

function sendNotification($stud_id, $lect_id, $sub_id, $class_id, $notif_type)
{
    include("../db_connect.php");
    $query = "SELECT sub_name FROM `subject` WHERE sub_id = '$sub_id' ";
    $result = $db->query($query);
    if ($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
    }
    if($notif_type == "1")
    {
        $notif_title = "Warning Letter #1 - ".$row['sub_name'];
        $notif_body = "You have been absent to FOUR classes. You will receive a second warning letter if you are absent from the following classes.";
    }
    else if($notif_type == "2")
    {
        $notif_title = "Warning Letter #2 - ".$row['sub_name'];
        $notif_body = "You have been absent to FIVE classes. You will receive a barring letter if you are absent for THREE more classes from the following classes.";
    }
    else if($notif_type == "3")
    {
        $notif_title = "Barring Letter - ".$row['sub_name'];
        $notif_body = "You have been absent to EIGHT classes. You have been barred from going to class for the subject. Please contact your respective HOP.";
    }
    $query = 
    "INSERT INTO `notification` (notif_type, notif_title, notif_body, stud_id, lect_id, sub_id, class_id) 
    VALUES ('$notif_type', '$notif_title', '$notif_body', '$stud_id', '$lect_id', '$sub_id', '$class_id') ";

    if ($db->query($query) === TRUE)
    {
        echo " <b>A warning letter has been sent to a student. </b><br>";
    }
    else
    {
        echo "Error: " . $query . "<br>" . $db->error;
    }
}

?>