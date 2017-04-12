<?php
print_r($_POST);

echo PHP_EOL;

echo $_POST["todaydate"];
echo $_POST["fname"];
echo $_POST["lname"];
echo $_POST["email"];
echo $_POST["major"];
echo $_POST["organization"];
echo $_POST["website"];
echo $_POST["location"];
echo $_POST["agency"];
echo $_POST["workdates-start"];
echo $_POST["workdates-end"];

$servername = "localhost";
$username = "root";
$password = "=76_kill_COMMON_market_8=";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";



?>