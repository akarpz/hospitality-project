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

$cutoff = "06-01";
$now = new DateTime();
$now = $now->format('m-d');
$now = "08-01";
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
        $sql_statement =    "SELECT * 
                             FROM Submission 
                             WHERE Submission_Date 
                             between '2017-04-18' and '2017-04-25'";
                        
    break;  
    
    case "":
        $sql_statement = "SELECT Student.First_Name, Student.Last_Name, Student.UDID, Submission.Hours_Worked 
                          FROM Student 
                          JOIN Student_Submissions ON Student_Submissions.UDID=Student.UDID 
                          JOIN Submission ON Submission.Submission_ID=Student_Submissions.Submission_ID  
                          ORDER BY Hours_Worked DESC";
}


//SELECT Student.First_Name, Student.Last_Name, Student.UDID, Submission.Hours_Worked 
//FROM Student 
//JOIN Student_Submissions ON Student_Submissions.UDID=Student.UDID 
//JOIN Submission ON Submission.Submission_ID=Student_Submissions.Submission_ID  
//ORDER BY Hours_Worked DESC;

if(!$result = $conn->query($sql_statement)) {
    echo "query failed: (" . $conn->errno . ") " . $conn->error;
}

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        print_r($row);
          $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim( $line ) . "\n";
}
$data = str_replace( "\r" , "" , $data );
    }
} else {
    echo "0 results";
}
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=report.xls");
header("Pragma: no-cache");
header("Expires: 0");


$conn->close();




?>
</pre></html>
