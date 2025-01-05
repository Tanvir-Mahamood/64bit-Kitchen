<?php
date_default_timezone_set('Asia/Dhaka');
$currentDateTime = date('y-m-d H:i:s');
echo "Current Date-Time: " . $currentDateTime;
echo "<br>";
$dateTimeString = $currentDateTime;
$dateTime = new DateTime($dateTimeString);
$date = $dateTime->format('Y-m-d');
$time = $dateTime->format('h:i A'); 

// Print the results
echo "Date = " . $date . "<br>";
echo "Time = " . $time;

?>