<?php

$to = "sooyongjie@gmail.com";
$subject = "I am not a virus.";
$txt = "Hello world!";
$headers = "From: wipeyourbuttocks@gmail.com" . "\r\n" .
"CC: j17025666@student.newinti.edu.my";

mail($to,$subject,$txt,$headers);

?>