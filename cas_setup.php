<?PHP

// auth-cas.php
// ------------------------------------------------
// require this file in any php 
// srcipt that requires
// authentication.  It will either re-direct the 
// user to proper place to authenticate or 
// (if the user is already authenticated) allow
// the including script to run.  
// ------------------------------------------------
// Version 2.7.1
// ------------------------------------------------
// 2.7.2      02/13/09
// - Added slash to end of $THIS_SERVER to seperate
//   from service name in url
// 2.7.1      02/07/09
// - Update made by James.M.Brabson@gmail.com
// - Now check for the existence of two variables
//   before their use to avoid PHP NOTICE errors
//   appearing in the error log.
// - Changed $THIS_SERVER to default to the
//   current server the script is running on
// - Changed $THIS_SCRIPT to default to the
//   current script that is being called
// - Changed $PROTOCOL to default to http
//   unless otherwise set
// - Removed unused $UNIQUE_ID variable
// 2.6.1      10/28/07
// - Changed $PROD_SERVER to cas.nss.udel.edu to 
//   match change in UD's infrastructure
// 2.6.0      08/23/07
// - Included authorization function is_authz()
// 2.5.1      07/19/07
// - Added $PROTOCOL parameter (optional) to allow
//   mixed http and https services on the server.
//   If not specified "https" it defaults to "http".
// VERSION HISTORY
// 2.5.0	01/02/05
// - Included authorization function authz_cas()
//   to username in a given MySQL database table
//   after CAS authentication
// - Added Error funtions and variables to allow 
//   customization of error messages

// 2.2		09/12/05
// - Fixed collision of $_SESSION['ticket'] on 
//   servers with multiple CAS applications by
//   changing to $_SESSION[$SERVICE_ID.'-ticket']
//
// 2.1		01/21/05
// - Added support for checking ticket via curl if
//   https is not a registered stream or fopen
//   fails for some other reason.  This allows the
//   script to work on a stock OS X server
// - Added setting and testing for a $THIS_SERVICE
//   session variable to indicate the user already
//   has been authenticated for this service
//
// 2.0		Before that
// - The first version we started version tracking


// USAGE
// -----------------------------------------------
// $THIS_SERVICE must be set before requiring
// this at the top of the PHP script to be
// authenticated.  If authentication succeeds the
// requiring script will continue execution past
// the point this file is included.  If not the 
// script will exit with an error message.
// 
// $STATUS should be set to "PRODUCTION" in the
// including script when you wish to utilize the 
// production cas server.  Not setting this variable
// or setting it to any other value will cause the
// test cas server to be used
//
// if $PROTOCOL is set, it is used otherwise 
// the service URL assumes http


// PARAMETERS
// Set these to match your server environment and needs
// =====================================================
//$TEST_SERVER="https://mis183.mis.udel.edu/cas/";
$TEST_SERVER="https://cas.nss.udel.edu/cas/";
$PROD_SERVER="https://cas.nss.udel.edu/cas/";

if (!isset($THIS_SERVER))
  $THIS_SERVER = $_SERVER["SERVER_NAME"];
if (!isset($THIS_SERVICE))
  $THIS_SERVICE = $_SERVER["SCRIPT_NAME"];

if (isset($PROTOCOL))
{
  if ($PROTOCOL != "https")
    $PROTOCOL = "http";
}
else
  $PROTOCOL = "http";
  
$THIS_SERVER=$PROTOCOL."://".$THIS_SERVER."/";

// ERROR MESSAGES
// ======================================================
$MSG_NOAUTH_TICKET="<h1>Authorization Error</h1><hr>You authorization attempt was not successful.  Your CAS ticket was not valid.";
$MSG_EXT_ERROR="<h1>System Error</h1><hr>This server cannot create an SSL connection in order to complete CAS authentication.  Please report this error to the server's administrator.";
$MSG_CON_ERROR = $MSG_EXT_ERROR;

// VARIABLE INITIALIZATION
// ======================================================
$response="";
$authenticated = 0;
if (isset($_GET["ticket"]))
  $ticket = $_GET["ticket"];
else
  $ticket = NULL;
if (!isset($STATUS) || $STATUS != "PRODUCTION" )
	$CAS_SERVER=$TEST_SERVER;
else   
	$CAS_SERVER=$PROD_SERVER;
$VALIDATE_URL=$CAS_SERVER."serviceValidate?ticket=".$ticket."&service=".$THIS_SERVER.$THIS_SERVICE;
$SERVICE_ID = sha1($THIS_SERVICE);

if (!function_exists('is_session_started'))
{
  function is_session_started()
  { if (isset($_SESSION)) return true; else return false; }
}

// MAIN CAS PROGRAM LOGIC
// ======================================================
// Skip AuthN if a session variable is 
// set for this service -- that means
// they already passed AuthN.
if (!is_session_started())
  session_start();
if (! isset($_SESSION[$SERVICE_ID])){
	if (! isset($ticket) ) {

// AuthN PHASE 1
// If there's no ticket set, redirect to the CAS server
// get a ticket.  Then exit so the rest of the script
// does not execute

		header("Location:".$CAS_SERVER."login?renew=true&service=".$THIS_SERVER.$THIS_SERVICE);
		exit(0);
	}
	else {

// AuthN PHASE 2
// If there is a ticket, validate it with CAS
// If valid, parse out the CAS2 XML returned
// (if any) to the $cas_data array.  Store this
// array as a session variable.  The presence
// of this registered session variable indicates
// the user is authenticated for future attemps.

// =========================================================
// TODO - sanity check the ticket to be sure there's nothing
//        goofy or malicious (check format w Luis...)
// =========================================================

		if ( extension_loaded("openssl") ) {
			if ($handle = fopen($VALIDATE_URL, "r")){
	   			while ($line=fgets($handle,1000)) {
	   				$response.=$line;
	   			}
	   			fclose ($handle);
			}
			else {
				print($MSG_CON_ERROR);
				exit(1);
			}
		}
                else if ( extension_loaded("curl") ) {
			$handle = curl_init($VALIDATE_URL);
			curl_setopt($handle, CURLOPT_HEADER, 0);
                        curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, 0);
			$response = curl_exec($handle);
			curl_close($handle);
                }
		else {
			print($MSG_EXT_ERROR);
			exit(1);
		}
		if ( ! validate_response($response) ) {
			print($MSG_NOAUTH_TICKET);
			exit(1);
		}
		else {
		// Valid ticket stored as session variable 'ticket'
			$_SESSION[$SERVICE_ID.'-ticket'] = $ticket;
			$parser = xml_parser_create();
			xml_parse_into_struct($parser,$response,$values,$tags);
			xml_parser_free($parser);
			foreach( $tags as $key=>$val ) {
				$key_parts = explode(":",$key);
                if (isset($values[$val[0]]["value"]))
				  $value = $values[$val[0]]["value"];
                else
                  $value = '';
				$index = $key_parts[1];
				$cas_data[$index] = $value;
			}

			// $cas_data array stored as session variable 'cas_data'
			$_SESSION['cas_data'] = $cas_data;

			// set a session variable to skip further login attempts
			$_SESSION[$SERVICE_ID] = "TRUE";
		}
	}

}



//========================================================
//FUNCTIONS
//========================================================
// validate_response()
//========================================================
// Validates the response returned from the
// CAS server when the ticket is presented
// (PHASE2).
//========================================================
function validate_response($response){
	$expected_regexp = "/<cas:authenticationSuccess>/";
	return( preg_match($expected_regexp, $response));
}

//========================================================
// authz_cas()
//========================================================
// authorize a CAS authenticated user against a MySQL
// database table column named UdelNetID
//
// For CAS 3:
// rather than print()/die() this needs to return a value
// relating to the status and let the calling app decide
// what to do.

function authz_cas($db,$table,$col,$conn){
  global $SERVICE_ID;
  if (!is_session_started())
    session_start();
  if(isset($_SESSION[$SERVICE_ID.'-ticket'])){
    $cas_data = $_SESSION['cas_data'];
    mysql_select_db($db, $conn);
    $query = "SELECT * from $table WHERE $col = '".$cas_data['USER']."'";
    $result = mysql_query($query);
    if (!$result || (mysql_num_rows($result) < 1)){
      print ("<h1>Access Denied</h1>");
      print ("You have been authenticated by CAS, but you do not have authorization to access this application.");
      die();
    }
  }
  else {
     print("<h1>Access Denied</h1>");
     print("CAS authentication was not completed successfully.");
     die();
  }
}

function is_authz_cas($db,$table,$col,$conn){
    global $SERVICE_ID;
    if (!is_session_started())
      session_start(); 
    if(isset($_SESSION[$SERVICE_ID.'-ticket'])){
      $cas_data = $_SESSION['cas_data'];
      mysql_select_db($db, $conn);
      $query = "SELECT * from $table WHERE $col = '".$cas_data['USER']."'";
      $result = mysql_query($query);
      if (!$result || (mysql_num_rows($result) < 1))
       return 0;
      else
       return 1;
    }
}
?>
