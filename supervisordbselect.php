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

if (!($submission_lookup = $conn->prepare("SELECT * FROM Submission WHERE Supervisor_Form_Link=?"))) {
     echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}

if (!$submission_lookup->bind_param("s", $ref)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

if (!$submission_lookup->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

$submission_lookup->bind_result($sub_id, $sup_id, $website, $address);

$submission_lookup->fetch();

$submission_lookup->close();

//match submission id to student id, then lookup student info to print

$mysqli->close();

print_r($submission_match);

?>
