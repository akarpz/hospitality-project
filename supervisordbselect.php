<?php
$browser_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

print_r($_GET);

print_r($browser_url); //debug statement, remove later

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
echo "Connected successfully";

//prepare insert
if (!($stmt = $conn->prepare("SELECT * FROM Submission WHERE Supervisor_Form_Link=?"))) {
     echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}

echo "prepared successfully";

// bind variable to parameter
if (!$stmt->bind_param("s", $browser_url)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

echo "binded successfully";

//execute
if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

echo "executed successfully";

/* bind result variables */
$stmt->bind_result($submission_match);

echo "bind result successful";

/* fetch value */
$stmt->fetch();

echo "fetch successful";

/* close statement */
$stmt->close();

/* close connection */
$mysqli->close();

print_r($submission_match);

echo "Executed successfully";

//next, echo this data to the fields below

?>
