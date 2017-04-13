<?php

print_r($_GET);

$servername = "localhost";
$username = "root";
$password = "=76_kill_COMMON_market_8=";
$db_name = "hospitality-serviceform-db";
$submission_match ="";

$conn = new mysqli($servername, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully" . PHP_EOL;

//prepare insert
if (!($stmt = $conn->prepare("SELECT * FROM Submission WHERE Supervisor_Form_Link=?"))) {
     echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}

echo "prepared successfully" . PHP_EOL;

// bind variable to parameter
if (!$stmt->bind_param("s", $browser_url)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

echo "binded successfully" . PHP_EOL;

//execute
if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

echo "executed successfully" . PHP_EOL;

/* bind result variables */
$stmt->bind_result($submission_match);

echo "bind result successful" . PHP_EOL;

/* fetch value */
$stmt->fetch();

echo "fetch successful" . PHP_EOL;

/* close statement */
$stmt->close();

/* close connection */
$mysqli->close();

print_r($submission_match);

echo "Executed successfully" . PHP_EOL;

//next, echo this data to the fields below

?>
