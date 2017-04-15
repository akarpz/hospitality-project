<html>
    <pre>
        <?php
            print_r($_POST);
        ?>

<?php
session_start();
if(!isset($_SESSION['cas_data'])){
    header("Location: http://serviceforms.lerner.udel.edu/index.php");
}

echo PHP_EOL;

$servername = "localhost";
$username = "root";
$password = "=76_kill_COMMON_market_8=";
$db_name = "hospitality-serviceform-db";
$hash;


// Create connection
$conn = new mysqli($servername, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

//check for student
//if student exists, create new record. else do nothing
check_student();
echo "complete everything";
function check_student() {
    echo "checking student" . PHP_EOL;
    global $conn;
    if(!$result = $conn->prepare('SELECT UDID FROM Student WHERE UDID = ?')) {
        echo "Check for Student Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
    echo "Type of variable #1" . gettype($result) . PHP_EOL;
    if(!$result->bind_param('s', $_POST["id"])) {
        echo "Check for Student Bind failed: (" . $conn->errno . ") " . $conn->error;
    }
    if(!$result->execute()) {
        echo "Check for student Execute failed: (" . $conn->errno . ") " . $conn->error;
    // }
    // $result->bind_result($udid);
    // while($result->fetch()) {
    //     echo "UDID match: " . $udid . PHP_EOL;
    // }
    // echo "UDID"
    // echo "number of rows in student check: " . $result->num_rows . PHP_EOL;
    if($result->num_rows > 0) {
        echo "student exists" . PHP_EOL;
	    $result->close();
        check_supervisor();
    }
    else{
	$result->close();
    echo "creating new student" . PHP_EOL;
    if(!$newstudent = $conn->prepare("INSERT INTO Student (UDID, First_Name, Last_Name, Major, Student_Email) VALUES (?, ?, ?, ?, ?)")) {
        echo "Student Insert Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
	echo "Type of variable #2" . gettype($newstudent) . PHP_EOL;
	$newstudent->bind_param("sssss", $_POST["id"], $_POST["fname"], $_POST["lname"], $_POST["major"], $_POST["email"]);
    $newstudent->execute();
    $newstudent->close();
    echo "finished checking student" . PHP_EOL;
    check_supervisor();
    }
}

function check_supervisor() {
    echo "checking supervisor" . PHP_EOL;
    global $conn;
    if(!$result = $conn->prepare('SELECT Supervisor_ID FROM Supervisor WHERE Supervisor_Email = ?')) {
        echo "Check for supervisor Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
    $result->bind_param('s', $_POST["supemail"]);
    $result->execute();
    $result->bind_result($supervisor_id);
    $result->fetch();
    echo "Number of rows in supervisor check: " . $result->num_rows . PHP_EOL;
    if($result->num_rows > 0) {
        echo "supervisor exists" . PHP_EOL;
	$result->close();
        create_submission($supervisor_id);
	
    }
    else{
    	$result->close();
        //create new supervisor record with prepared statement
        if(!$newsupervisor = $conn->prepare('INSERT INTO Supervisor Values (0, ?, ?, ?, ?, ?, ?, ?)')) {
                echo "Supervisor Insert Prepare failed: (" . $conn->errno . ") " . $conn->error;
        }
    	echo "Newsupervisor object type: " . gettype($newsupervisor);
        $newsupervisor->bind_param("sssssii", $_POST["supfname"], $_POST["suplname"], $_POST["suptitle"], $_POST["supemail"], $_POST["supphone"], $_POST["supstudent?"], $_POST["suprelative?"]);
        $newsupervisor->execute();
        $newsupervisorid = $conn->insert_id;
        $newsupervisor->close();
        echo "finished checking supervisor" . PHP_EOL;
        create_submission($newsupervisorid);
    }
}

function create_submission($supervisor_id) { 
    echo "checking submission" . PHP_EOL;
    global $conn, $hash;
    $hashinput = $_POST["todaydate"] . $_POST["workdates-start"] . $_POST["workdates-end"];
    $hash = secure($hashinput, $supervisor_id, 100);
    //create the rest of submission
    echo "Hash value: " . $hash . PHP_EOL;
    if(!$newsubmission = $conn->prepare('INSERT INTO Submission VALUES (0, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
        echo "Submission Insert Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
    $newsubmission->bind_param("isssssisssssis", $supervisor_id, $_POST["website"], $_POST["location"], $_POST["agency"], $_POST["workdates-start"], 
    $_POST["workdates-end"], $_POST["hoursworked"], $_POST["activities"], $_POST["valuesite"], $_POST["valueyou"],
    $_POST["todaydate"], $hash);
    
    $newsubmission->execute();
    $submission_id = $conn->insert_id;
    $newsubmission->close();
    echo "finished checking submission" . PHP_EOL;
    create_student_submission($submission_id);
}

function create_student_submission($submission_id) {
    echo "checking student submission" . PHP_EOL;
    global $conn;
    $new_student_submission_record = $conn->prepare('INSERT INTO Student_Submissions VALUES (?, ?)');
    $new_student_submission_record->bind_param("ss", $_POST["id"], $submission_id);
    $new_student_submission_record->execute();
    $new_student_submission_record->close();
    echo "finished checking student submission" . PHP_EOL;
}

//create hash for supervisor link
function secure($password, $salt, $iter) {
    global $hash;
    echo "hashing" . PHP_EOL;
    $temp = hash("sha256","0".$password.$salt);
    for($i=0;$i<$iter-1;$i++) {
       $temp = strtoupper(hash("sha256",$temp.$password.$salt));
    }
    echo "done hashing" . PHP_EOL;
    return $temp;
}
echo "closing connection" . PHP_EOL;
$conn->close();
print_r("http://serviceforms.lerner.udel.edu/supervisorform.php?ref=" . $hash);
//redirect to page with hash, or email
?>
</pre>
</html>
