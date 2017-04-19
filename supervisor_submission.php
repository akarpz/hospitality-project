<?php

session_start();
if(!isset($_SESSION['cas_data'])){
    //header("Location: http://serviceforms.lerner.udel.edu/index.php");
}

if($_POST["supstudent?"] == "yes" || $_POST["suprelative?"] == "yes") {
    die("Submission not approved because You claimed to be a student or relative of the Student. Please Resubmit form with those selections
        set to \"no\".");
}

$servername = "localhost";
$username = "root";
$password = "=76_kill_COMMON_market_8=";
$db_name = "hospitality-serviceform-db";

$conn = new mysqli($servername, $username, $password, $db_name);

if(!$submission_approval = $conn->prepare("UPDATE Submission SET Approved'?' = true WHERE Submission_ID = ?")) {
    echo "Submission Approval Prepare failed: (" . $conn->errno . ") " . $conn->error;
}
if(!$submission_approval->bind_param("i", $_POST["sub_id"])) {
    echo "Submission Approval Bind Param failed: (" . $conn->errno . ") " . $conn->error;
}

if(!$submission_approval->execute()) {
    echo "Submission Approval Execute failed: (" . $conn->errno . ") " . $conn->error;
}

?>