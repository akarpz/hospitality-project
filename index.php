<html>
    <body>
<?php
session_start();
include 'cas_setup.php';

echo 'Hello world from Hospitality!';

echo "<br>";
echo "<br>";
?>

<pre>
  
<?php

print_r($_SESSION);

?>

</pre>

<?php

echo "<br>";
echo "<br>";

$usertype = $_SESSION['cas_data']['PERSONTYPE'];

function isstudent($usertype) {
  //$usertype = ucwords($usertype);
  if (strpos($usertype, 'STUDENT') !== false) {
    return true;
  }
  else {
    return false;
  }
}

function isapprovedfaculty() {

  //check cas_data against approved internal user table in db
    //if match, redirect to internal user view, otherwise redirect to student view
}

if(isstudent($usertype)){
    echo 'true';
	echo $_SESSION['cas_data']['LASTNAME'];
    header("Location: http://serviceforms.lerner.udel.edu/disclaimer.php");
    exit();
}else {
    echo 'false';
}



?>

</body>
</html>
