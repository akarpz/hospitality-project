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
echo "Connected successfully" . PHP_EOL;

//prepare select
if (!($submission_lookup = $conn->prepare("SELECT * FROM Submission WHERE Supervisor_Form_Link=?"))) {
     echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}

echo "prepared successfully" . PHP_EOL;

// bind variable to parameter
if (!$submission_lookup->bind_param("s", $ref)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

echo "binded successfully" . PHP_EOL;

//execute
if (!$submission_lookup->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

echo "executed successfully" . PHP_EOL;

/* bind result variables */
$submission_lookup->bind_result($sub_id, $sup_id, $website, $address);

echo "bind result successful" . PHP_EOL;

/* fetch value */
$submission_lookup->fetch();

echo "fetch successful" . PHP_EOL;

/* close statement */
$submission_lookup->close();

//match submission id to student id, then lookup student info to print

/* close connection */
$mysqli->close();

print_r($submission_match);

echo "Executed successfully" . PHP_EOL;

//next, echo this data to the fields below

?>
