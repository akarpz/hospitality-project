<html><pre>
<?php

$servername = "localhost";
$username = "root";
$password = "=76_kill_COMMON_market_8=";
$db_name = "hospitality-serviceform-db";

$conn = new mysqli($servername, $username, $password, $db_name);

$ref = $_GET["ref"];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$submission_lookup->close();
$cutoff = "06-01";
$now = new DateTime();
$now = $now->format('m-d');
echo $now;
echo "something in between";
echo $cutoff;
if($now<$cutoff) {
    echo "we are in the current year";
    $yearnow = new DateTime();
    $yearnow = $yearnow->format('y');
    $yearone = $yearnow-1;
    $yeartwo = $yearone-1;
    
    
}
else {
    echo "this is not the current year";
    $yearnow = new DateTime();
    $yearnow = $yearnow->format('y');
    $yearone = $yearnow;
    $yeartwo = $yearnow-1;
    
}
echo PHP_EOL;
echo $yearone . PHP_EOL;
echo $yeartwo . PHP_EOL;

$yearone = "20" . $yearone;
$yeartwo = "20" . $yeartwo;
$yearone =  $yearone . "-5" . "-31";
$yeartwo =  $yeartwo . "-8" . "-25";
echo "yearone: " . $yearone . PHP_EOL;
echo "yeartwo: " . $yeartwo;
 



switch($ref) {
    case "all":
        $sql_statement = "SELECT * FROM Submission sub 
                            JOIN Student stu 
                            JOIN Supervisor sup
                            JOIN Student_Submissions ss";
    break;
    
    case "last":
        $sql_statement = "SELECT * FROM Submission sub
                            JOIN Student stu 
                            JOIN Supervisor sup
                            JOIN Student_Submissions ss
                            WHERE sub.Submission_Date between '$yeartwo' and '$yearone'";
                        
    break;  
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        print_r($row);
    }
} else {
    echo "0 results";
}

$conn->close();



?>
</pre></html>