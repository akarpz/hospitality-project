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

$cutoff = "06-01";
$now = new DateTime();
$now = $now->format('m-d');
if($now < $cutoff) {
    //echo "we are in the current year";
    $yearnow = new DateTime();
    $yearnow = $yearnow->format('y');
    $yearone = $yearnow-1;
    $yeartwo = $yearone-1;
    
    
}
else {
    //echo "this is not the current year";
    $yearnow = new DateTime();
    $yearnow = $yearnow->format('y');
    $yearone = $yearnow;
    $yeartwo = $yearnow-1;
    
}
$yearone = "20" . $yearone;
$yeartwo = "20" . $yeartwo;
$yearone =  $yearone . "-5" . "-31";
$yeartwo =  $yeartwo . "-8" . "-25";

echo "Year Two (former year): " . $yeartwo . PHP_EOL;
echo "Year One (latter year): " . $yearone . PHP_EOL;

switch($ref) {
    case "all":
        $sql_statement = "SELECT * FROM Submission 
                            JOIN Student
                            JOIN Supervisor
                            JOIN Student_Submissions";
    break;
    
    case "last":
        $sql_statement = "SELECT * 
                            FROM Submission 
                            WHERE Submission_Date 
                            between '" . $yeartwo . "' and '" . $yearone . "'";
                        
    break;
    
    case "josh":
        $sql_statement = "SELECT Student.First_Name, Student.Last_Name, Student.UDID, Submission.Hours_Worked 
                          FROM Student 
                          JOIN Student_Submissions ON Student_Submissions.UDID=Student.UDID 
                          JOIN Submission ON Submission.Submission_ID=Student_Submissions.Submission_ID  
                          ORDER BY Hours_Worked DESC";
    break;
    
    case "debug":
	    $sql_statement = "Select * FROM Submission";
    break;
    
    case "stu":
        $sql_statement = "SELECT * FROM Student";
    break;
    
    case "sup":
        $sql_statement = "SELECT * FROM Supervisor";
    break;
}

if(!$result = $conn->query($sql_statement)) {
    echo "query failed: (" . $conn->errno . ") " . $conn->error;
}
$filename = "/reports/report.csv";
if (file_exists($filename)) {
    unlink($filename);
}

$fp = fopen($filename,'w+');

if ($result->num_rows > 0) {
    $finfo = $result->fetch_fields();
    foreach ($finfo as $val) {
        fputcsv($fp, $val);
    }
    while($row = $result->fetch_assoc()) {
	    fputcsv($fp, $row);
    }
} else {
	echo "no results";
}

$conn->close();
$outputfilename = "report_" . $now . ".csv";
fclose($fp);
header("Content-type: application/octet-stream");
header("Content-Transfer-Encoding; CSV");
header("Content-Disposition: attachment; filename=" . $outputfilename);
//header("Pragma: no-cache");
//header("Expires: 0");
readfile($filename);
?>
