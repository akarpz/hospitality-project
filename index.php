<html>
    <body>
<?php
session_start();
// A simple web site in Cloud9 that runs through Apache
// Press the 'Run' button on the top to start the web server,
// then click the URL that is emitted to the Output tab of the console
include 'cas_setup.php';

echo 'Hello world from Hospitality!';

echo "<br>";
echo "<br>";

print_r($_SESSION);


echo "<br>";
echo "<br>";

print_r($_SESSION['cas_data']);

echo "<br>";
echo "<br>";

print_r(session_status());
print_r(is_session_started());
print_r(isset($_SESSION));
print_r($_SESSION["cas_data"]["FIRSTNAME"]);

echo "starting session";

print_r($_SESSION['cas_data']);

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

if(isstudent($usertype)){
    echo 'true';
	echo $_SESSION['cas_data']['LASTNAME'];
    //header("Location: http://serviceforms.lerner.udel.edu/index.html");
    exit();
}else {
    echo 'false';
}



?>

</body>
</html>
