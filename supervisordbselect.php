<?php

print_r($_GET);

$servername = "localhost";
$username = "root";
$password = "=76_kill_COMMON_market_8=";
$db_name = "hospitality-serviceform-db";
$submission_match ="";

$conn = new mysqli($servername, $username, $password, $db_name);

$ref = $_GET["ref"];

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!($submission_lookup = $conn->prepare("SELECT Agency_Address, Non-Profit_Benefactor, Start_Date_Work, End_Date_Work, Hours_Worked, Activity_Description FROM Submission WHERE Supervisor_Form_Link=?"))) {
     echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}

if (!$submission_lookup->bind_param("s", $ref)) {
    echo "Binding parameters failed: (" . $conn->errno . ") " . $conn->error;
}

if (!$submission_lookup->execute()) {
    echo "Execute failed: (" . $conn->errno . ") " . $conn->error;
}

if(!$submission_lookup->bind_result($address, $agency, $startdate, $enddate, $hours, $description)) {
    echo "Bind Result failed: (" . $conn->errno . ") " . $conn->error;
}

if(!$submission_lookup->fetch()) {
    echo "Fetch failed: (" . $conn->errno . ") " . $conn->error;
}

$submission_lookup->close();

//match submission id to student id, then lookup student info to print

$mysqli->close();

print_r($submission_match);

?>
