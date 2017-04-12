<html>
    <pre>
        <?php
            print_r($_POST);
        ?>
    </pre>
</html>

<?php

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

//check for student
//if student exists, create new record. else do nothing

//check for supervisor
//if supervisor exists, create new record. else do nothing

//create hash for supervisor link
function secure($password, $salt, $iter) {
       $temp = hash("sha256","0".$password.$salt);
       for($i=0;$i<$iter-1;$i++){
           $temp = strtoupper(hash("sha256",$temp.$password.$salt));
       }
       return $temp;
}

$submission_insert = "INSERT INTO submission VALUES ('$_POST["fname"]', 'Doe', 'john@example.com')";

if ($conn->query($submission_insert) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $submission_insert . "<br>" . $conn->error;
}

//create submission record

//create record in student_submission table

$conn->close();

//redirect to page with hash, or email
?>