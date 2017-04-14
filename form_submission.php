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
    $result = $conn->prepare('SELECT UDID FROM Student WHERE UDID = ?');
    echo "Type of variable #1" . gettype($result) . PHP_EOL;
    $result->bind_param('s', $_POST["id"]);
    $result->execute();
    $result->bind_result($udid);
    $result->fetch();
    print_r($result);
    if($result->num_rows > 0) {
        echo "student exists" . PHP_EOL;
        check_supervisor();
        $result->close();
    }
    else{
    echo "creating new student" . PHP_EOL;    
    $newstudent = $conn->prepare("INSERT INTO Student (UDID, First_Name, Last_Name, Major, Student_Email) VALUES (?, ?, ?, ?, ?)");
	echo "Type of variable #2" . gettype($newstudent) . PHP_EOL;
	echo gettype($_POST["id"]);
	echo gettype($_POST["fname"]);
	echo gettype($_POST["lname"]);
	echo gettype($_POST["major"]);
	echo gettype($_POST["email"]);
	$newstudent->bind_param("sssss", $_POST["id"], $_POST["fname"], $_POST["lname"], $_POST["major"], $_POST["email"]);
    $newstudent->execute();
    echo "finished checking student" . PHP_EOL;
    check_supervisor();
    }
}

function check_supervisor() {
    echo "checking supervisor" . PHP_EOL;
    global $conn;
    $result = $conn->prepare('SELECT Supervisor_ID FROM Supervisor WHERE Supervisor_Email = ?');
    $result->bind_param('s', $_POST["supemail"]);
    $result->execute();
    $result->bind_result($supervisor_id);
    $result->fetch();
    print_r($result);
    if($result->num_rows > 0) {
        echo "supervisor exists" . PHP_EOL;
        create_submission($supervisor_id);
        $result->close();
    }
    else{
        //create new supervisor record with prepared statement
        $newsupervisor = $conn->prepare('INSERT INTO Supervisor Values (?,?,?,?,?,?,?)');
        $newsupervisor->bind_param("sssssii", $_POST["supfname"], $_POST["suplname"], $_POST["suptitle"], $_POST["supemail"], $_POST["supphone"], $_POST["supstudent?"], $_POST["suprelative?"]);
        $newsupervisor->execute();
        $newsupervisorid = $conn->insert_id;
        echo "finished checking supervisor" . PHP_EOL;
        create_submission($newsupervisorid);
    }
}

function create_submission($supervisor_id) { 
    echo "checking submission" . PHP_EOL;
    global $conn;
    $hashinput = $_POST["todaydate"] . $_POST["workdates-start"] . $_POST["workdates-end"];
    $hash = secure($hashinput, $supervisor_id, 100);
    //create the rest of submission
    
    $newsubmission = $conn->prepare('INSERT INTO Submission VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?');
    $newsubmission->bind_param("isssssisssssis", $supervisor_id, $_POST["website"], $_POST["location"], $_POST["agency"], $_POST["workdates-start"], 
    $_POST["workdates-end"], $_POST["hoursworked"], $_POST["activities"], $_POST["valuesite"], $_POST["valueyou"],
    $_POST["todaydate"], $_POST["hash"]);
    
    $newsubmission->execute();
    $submission_id = $conn->insert_id;
    echo "finished checking submission" . PHP_EOL;
    create_student_submission($submission_id);
}

function create_student_submission($submission_id) {
    echo "checking student submission" . PHP_EOL;
    global $conn;
    $statement = $conn->prepare('INSERT INTO Student_Submissions VALUES (?, ?)');
    $statement->bind_param("ss", $_POST["id"], $submission_id);
    $statement->execute();
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
