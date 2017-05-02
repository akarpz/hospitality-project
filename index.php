<html>
<pre>
<?php
session_start();
include 'cas_setup.php';

print_r($_SESSION);

$_SESSION['cas_data']['USER'] = 33822;

function isstudent($usertype) {
  if (strpos($usertype, 'STUDENT') !== false) {
    return true;
  }
  else {
    return false;
  }
}

function isapprovedfaculty($udid) {
  $servername = "localhost";
  $username = "root";
  $password = "=76_kill_COMMON_market_8=";
  $db_name = "hospitality-serviceform-db";
  $sql = "SELECT UDID FROM approved_internal_users WHERE UDID='" . $udid . "'";
  
  $conn = new mysqli($servername, $username, $password, $db_name);


  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  
  if(!$result = $conn->query($sql)) {
    echo "Internal User Query failed: (" . $conn->errno . ") " . $conn->error;
  }
  
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          if($udid == $row["UDID"]) {
            return true;
          }
      }
  } else {
      return false;
  }
}

if(isapprovedfaculty($_SESSION['cas_data']['USER'])) {
  header("Location: /internalviews.php");
  exit();
}
else if(isstudent($_SESSION['cas_data']['PERSONTYPE'])){
  header("Location: http://serviceforms.lerner.udel.edu/disclaimer.php");
  exit();
}else{
  echo 'false';
  exit();
}

?>
</pre>
</html>
