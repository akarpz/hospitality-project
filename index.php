<html>
    <body>
<?php
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
}else {
    echo 'false';
}

?>

</body>
</html>
