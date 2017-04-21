<?php 
// session_start();
// if(!isset($_SESSION['cas_data'])){
//     //header("Location: http://serviceforms.lerner.udel.edu/index.php");
// }

// $servername = "localhost";
// $username = "root";
// $password = "=76_kill_COMMON_market_8=";
// $dbname = "hospitality-serviceform-db";

// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// if (!($sub_id_lookup = $conn->prepare("SELECT Submission_ID FROM Student_Submissions WHERE UDID = ?"))) {
//      echo "Student_Submissions Prepare failed: (" . $conn->errno . ") " . $conn->error;
// }

// if (!$sub_id_lookup->bind_param("s", $_SESSION["cas_data"]["UDELNETID"])) {
//     echo "Student_Submissions Binding parameters failed: (" . $conn->errno . ") " . $conn->error;
// }

// if (!$sub_id_lookup->execute()) {
//     echo "Student_Submissions Execute failed: (" . $conn->errno . ") " . $conn->error;
// }

// $sub_id_lookup->bind_result($submission_id_match);


// $i=0;
// $submission_ids = [];
// while($sub_id_lookup->fetch()) {
// 	echo PHP_EOL . "Submission_ID match #" . $i . " : " . $submission_id_match . PHP_EOL;
// 	$submission_ids[$i] = $submission_id_match;
// 	$i++;
// }

// $sub_id_lookup->close();

// if(!($sub_lookup = $conn->prepare("SELECT Non_Profit_Benefactor, Hours_Worked, Submission_Date, Approved FROM Submission WHERE Submission_ID = ?"))) {
// 	echo "Submission Prepare failed: (" . $conn->errno . ") " . $conn->error;
// }

// echo "NUMBER OF RESULTS: " . count($submission_ids) . PHP_EOL;
// $submission_results_list = [];
// for($i = 0; $i < count($submission_ids); $i++) {
// 	if(!$sub_lookup->bind_param("i", $submission_ids[$i])) {
// 		echo "Submission Bind Param failed: (" . $conn->errno . ") " . $conn->error;
// 	}
// 	if(!$sub_lookup->execute()) {
// 		echo "Submission Execute failed: (" . $conn->errno . ") " . $conn->error;
// 	}
// 	if(!$sub_lookup->bind_result($benefactor, $hours_worked, $sub_date, $approved)) {
// 		echo "Submission Bind Result failed: (" . $conn->errno . ") " . $conn->error;
// 	}
// 	if(!$sub_lookup->fetch()) {
// 		echo "Submission Fetch failed: (" . $conn->errno . ") " . $conn->error;
// 	}
// 	$submission_results_list[$i] = [
// 		"benefactor" => $benefactor, 
// 		"hours_worked" => $hours_worked,
// 		"submission_date" => $sub_date,
// 		"approved?" => $approved];
// }
// echo PHP_EOL;
// print_r($submission_results_list);

// /* close connection */
// $conn->close();



?>