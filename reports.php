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

if(($now->format('m-d')) < $cutoff) {
    $previous_year_start = "20" . ($now->format('y') - 2) . "-8-25";
    $previous_year_end = "20" . $now->format('y') - 1 . "-5-31";
    $current_year_start = "20" . ($now->format('y') - 1) . "-8-25";
    $current_year_end = "20" . $now->format('y') . "-8-25";
} else {
    $previous_year_start = "20" . ($now->format('y') - 1) . "-8-25";
    $previous_year_end = "20" . $now->format('y') . "-5-31";
    $current_year_start = "20" . $now->format('y') . "-8-25";
    $current_year_end = "20" . ($now->format('y') + 1) . "-8-25";
}

echo "Start date of last academic year:  " . $previous_year_start . PHP_EOL;
echo "End date of last academic year: " . $previous_year_end . PHP_EOL;

echo "Start date of this academic year:  " . $current_year_start . PHP_EOL;
echo "End date of this academic year: " . $current_year_end . PHP_EOL;

switch($ref) {
    case "all":
        $sql_statement = "SELECT * FROM Submission 
                            JOIN Student
                            JOIN Supervisor
                            JOIN Student_Submissions";
    break;
    
    case "submissions_last_academic_year":
        $sql_statement = "SELECT * 
                            FROM Submission 
                            WHERE Submission_Date 
                            between '" . $previous_year_start . "' and '" . $previous_year_end . "'";
                        
    break;
    
    case "submissions_current_academic_year":
        $sql_statement = "SELECT * 
                            FROM Submission 
                            WHERE Submission_Date 
                            between '" . $current_year_start . "' and '" . $current_year_end . "'";
                        
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
    
    case "student_all":
        $sql_statement = "SELECT * FROM Student";
    break;
    
    case "student_current":
        $sql_statement = "SELECT Student.UDID, Student.First_Name, Student.Last_Name, Student.Major, Student.Email, Student.Phone 
                          FROM Student 
                          Join Student_Submissions ON Student_Submissions.UDID = Student.UDID
                          Join Submission ON Submission.Submission_ID = Student_Submissions.Submission_ID
                          WHERE Submission.Date between '" . $current_year_start . "' AND '" . $current_year_end . "'";
    break;
    
    case "student_previous":
        $sql_statement = "SELECT Student.UDID, Student.First_Name, Student.Last_Name, Student.Major, Student.Email, Student.Phone 
                          FROM Student 
                          Join Student_Submissions ON Student_Submissions.UDID = Student.UDID
                          Join Submission ON Submission.Submission_ID = Student_Submissions.Submission_ID
                          WHERE Submission.Date between '" . $previous_year_start . "' AND '" . $previous_year_end . "'";
    break;
    
    case "supervisor_all":
        $sql_statement = "SELECT First_Name, Last_Name, Supervisor_Title, Supervisor_Email, Supervisor_Phone FROM Supervisor";
    break;
    
    case "supervisor_current":
        $sql_statement = "SELECT First_Name, Last_Name, Supervisor_Title, Supervisor_Email, Supervisor_Phone 
                          FROM Supervisor
                          JOIN Submission ON Supervisor.Supervisor_ID = Submission.Supervisor_ID
                          WHERE Submission.Date between '" . $current_year_start . "' AND '" . $current_year_end . "'";
    break;
    
    case "supervisor_previous":
        $sql_statement = "SELECT First_Name, Last_Name, Supervisor_Title, Supervisor_Email, Supervisor_Phone 
                          FROM Supervisor
                          JOIN Submission ON Supervisor.Supervisor_ID = Submission.Supervisor_ID
                          WHERE Submission.Date between '" . $previous_year_start . "' AND '" . $previous_year_end . "'";
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
    $num = 0;
    foreach ($finfo as $val) {
	$columns[$num]= $val->name;
	$num++;
    }
    fputcsv($fp, $columns);
    while($row = $result->fetch_assoc()) {
	    fputcsv($fp, $row);
    }
} else {
	echo "There are no results that match that criteria. This is most likely because it is Summer and 
	        the current year has just started, or the databases have been recently cleared";
}

$conn->close();
$outputfilename = "report_" . $now->format('Y-m-d H:i:s') . ".csv";
fclose($fp);
header("Content-type: application/octet-stream");
header("Content-Transfer-Encoding; CSV");
header("Content-Disposition: attachment; filename=" . $outputfilename);
header("Pragma: no-cache");
readfile($filename);
?>
