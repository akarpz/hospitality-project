<html>
    <pre>
        <?php
            print_r($_POST);
        ?>
    </pre>
</html>

<?php
session_start();
if(!isset($_SESSION['cas_data'])){
    header("Location: http://serviceforms.lerner.udel.edu/index.php");
}

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
$hash;

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

//check for student
//if student exists, create new record. else do nothing
check_student();
function check_student() {
    if ($result = $conn->query('SELECT * FROM Student WHERE UDID = "'.$_POST["id"].'"')) {
        //then student exists
        check_supervisor();
        $result->close();
    }else{ //create new student record with prepared statement
    $newstudent = $conn->prepare('INSERT INTO Student Values (?, ?, ?, ?, ?)');
    $newstudent->bind_param("sssss", $_POST["id"], $_POST["fname"], $_POST["lname"], $_POST["major"], $_POST["email"]);
    $newstudent->execute();
    check_supervisor();
    }
}

function check_supervisor() {
    //check for supervisor
    if ($result = $conn->query('SELECT * FROM Supervisor WHERE Supervisor_Email = "'.$_POST["supemail"].'"')) {
        //then supervisor exists
        create_submission($result["Supervisor_ID"]);
        $result->close();
    }else{
        //create new supervisor record with prepared statement
        $newsupervisor = $conn->prepare('INSERT INTO Supervisor Values(?,?,?,?,?,?,?)');
        $newsupervisor->bind_param("sssssii", $_POST["supfname"], $_POST["suplname"], $_POST["suptitle"], $_POST["supemail"], $_POST["supphone"], $_POST["supstudent?"], $_POST["suprelative?"]);
        $newsupervisor->execute();
        $newsupervisorid = $conn->insert_id;
        create_submission($newsupervisorid);
    }
}

function create_submission($supervisor_id) {
    $hashinput = $_POST["todaydate"] . $_POST["workdates-start"] . $_POST["workdates-end"];
    $hash = secure($hashinput, $supervisor_id, 100);
    //create the rest of submission
    
    $newsubmission = $conn->prepare('INSERT INTO Submission VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?');
    $newsubmission->bind_param("isssssisssssis", $supervisor_id, $_POST["website"], $_POST["location"], $_POST["agency"], $_POST["workdates-start"], 
    $_POST["workdates-end"], $_POST["hoursworked"], $_POST["activities"], $_POST["valuesite"], $_POST["valueyou"],
     $_POST["todaydate"], $_POST["hash"]);
    
    $newsubmission->execute();
    $submission_id = $conn->insert_id;
    create_student_submission($submission_id);
}

function create_student_submission($submission_id) {
    $statement = $conn->prepare('INSERT INTO Student_Submissions VALUES (?, ?)');
    $statement->bind_param("ss", $_POST["id"], $submission_id);
    $statement->execute();
}

//create hash for supervisor link
function secure($password, $salt, $iter) {
       $temp = hash("sha256","0".$password.$salt);
       for($i=0;$i<$iter-1;$i++) {
           $temp = strtoupper(hash("sha256",$temp.$password.$salt));
       }
       return $temp;
}

$conn->close();

print_r("http://serviceforms.lerner.udel.edu/supervisorform.php?ref=" . $hash);
//redirect to page with hash, or email
?>
