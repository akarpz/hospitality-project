<?php 
session_start();
if(!isset($_SESSION['cas_data'])){
    //header("Location: http://serviceforms.lerner.udel.edu/index.php");
}

$servername = "localhost";
$username = "root";
$password = "=76_kill_COMMON_market_8=";
$dbname = "hospitality-serviceform-db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!($sub_id_lookup = $conn->prepare("SELECT Submission_ID FROM Student_Submissions WHERE UDID = ?"))) {
     echo "Student_Submissions Prepare failed: (" . $conn->errno . ") " . $conn->error;
}

if (!$sub_id_lookup->bind_param("s", $_SESSION["cas_data"]["UDELNETID"])) {
    echo "Student_Submissions Binding parameters failed: (" . $conn->errno . ") " . $conn->error;
}

if (!$sub_id_lookup->execute()) {
    echo "Student_Submissions Execute failed: (" . $conn->errno . ") " . $conn->error;
}

$sub_id_lookup->bind_result($submission_id_match);


$i=0;
$submission_ids = [];
while($sub_id_lookup->fetch()) {
	echo PHP_EOL . "Submission_ID match #" . $i . " : " . $submission_id_match . PHP_EOL;
	$submission_ids[$i] = $submission_id_match;
	$i++;
}

$sub_id_lookup->close();

if(!($sub_lookup = $conn->prepare("SELECT Non_Profit_Benefactor, Hours_Worked, Submission_Date, Approved FROM Submission WHERE Submission_ID = ?"))) {
	echo "Submission Prepare failed: (" . $conn->errno . ") " . $conn->error;
}

echo "NUMBER OF RESULTS: " . count($submission_ids) . PHP_EOL;
$submission_results_list = [];
for($i = 0; $i < count($submission_ids); $i++) {
	if(!$sub_lookup->bind_param("i", $submission_ids[$i])) {
		echo "Submission Bind Param failed: (" . $conn->errno . ") " . $conn->error;
	}
	if(!$sub_lookup->execute()) {
		echo "Submission Execute failed: (" . $conn->errno . ") " . $conn->error;
	}
	if(!$sub_lookup->bind_result($benefactor, $hours_worked, $sub_date, $approved)) {
		echo "Submission Bind Result failed: (" . $conn->errno . ") " . $conn->error;
	}
	if(!$sub_lookup->fetch()) {
		echo "Submission Fetch failed: (" . $conn->errno . ") " . $conn->error;
	}
	$submission_results_list[$i] = [
		"benefactor" => $benefactor, 
		"hours_worked" => $hours_worked,
		"submission_date" => $sub_date,
		"approved?" => $approved];
}
echo PHP_EOL;
print_r($submission_results_list);

/* close connection */
$conn->close();



?>
<html lang="en-US"><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Hospitality: Community Service – myLerner</title>

<style type="text/css"></style>

<link rel="dns-prefetch" href="//maxcdn.bootstrapcdn.com">
<link rel="dns-prefetch" href="//fonts.googleapis.com">

<head>
<link rel="stylesheet" href="https://cdn.webix.com/edge/webix.css" type="text/css"> 
<script src="https://cdn.webix.com/edge/webix.js" type="text/javascript"></script> 
</head>

<link rel="stylesheet" id="font-awesome-css" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css?ver=4.6.3" type="text/css" media="all">
<link rel="stylesheet" id="colormag_google_fonts-css" href="//fonts.googleapis.com/css?family=Open+Sans%3A400%2C600&amp;ver=4.7.3" type="text/css" media="all">
<link rel="stylesheet" id="colormag_style-css" href="themes/mylerner/style.css" type="text/css" media="all">
<link rel="stylesheet" id="colormag-fontawesome-css" href="themes/colormag/fontawesome/css/font-awesome.css" type="text/css" media="all">

<link rel="shortcut icon" href="themes/img/favicon.png" type="image/x-icon"><style id="fit-vids-style">.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style></head>

<body class="post-template-default single single-post postid-236 single-format-standard  wide">
<div id="page" class="hfeed site">
		<header id="masthead" class="site-header clearfix">
		<div id="header-text-nav-container" class="clearfix">
            <div class="news-bar">
               <div class="inner-wrap clearfix">
                    <div class="date-in-header" id="header-date">Date Locaton</div>
                  
    <div class="social-links clearfix">
		<ul>
		    <li><a href="https://www.facebook.com/UDLerner/" target="_blank"><i class="fa fa-facebook"></i></a></li><li><a href="https://twitter.com/UDLernerCollege" target="_blank"><i class="fa fa-twitter"></i></a></li>
		</ul>
	</div><!-- .social-links -->
	           </div>
            </div>
			
			<div class="inner-wrap">

				<div id="header-text-nav-wrap" class="clearfix">
					<div id="header-left-section">
							<div id="header-logo-image">

								<a href="http://my.lerner.udel.edu/" title="myLerner" rel="home"><img src="themes/img/myLerner-logo.png" alt="myLerner"></a>
							</div><!-- #header-logo-image -->
												<div id="header-text" class="screen-reader-text">
                                             <h3 id="site-title">
                           <a href="http://my.lerner.udel.edu/" title="myLerner" rel="home">myLerner</a>
                        </h3>
                     							<!-- #site-description -->
						</div><!-- #header-text -->
					</div><!-- #header-left-section -->
					<div id="header-right-section"></div><!-- #header-right-section -->

			   </div><!-- #header-text-nav-wrap -->

			</div><!-- .inner-wrap -->
			
			<nav id="site-navigation" class="main-navigation clearfix" role="navigation">
				<div class="inner-wrap clearfix">
					                  <div class="home-icon">
                     <a href="http://my.lerner.udel.edu/" title="myLerner"><i class="fa fa-home"></i></a>
                  </div>
					                  <div class="home-icon">
                     <a href="/studentform.php" title="Submit service hours"><i class="fa fa-book"></i></a>
                  </div>
					                  <div class="home-icon">
                     <a href="/status.php" title="View your hours to date"><i class="fa fa-user" aria-hidden="true"></i></a>
                </div>
			</nav>

		</div><!-- #header-text-nav-container -->
		
	</header>
			<div id="main" class="clearfix">
		<div class="inner-wrap clearfix">

	
	<div id="primary">
		<div id="content" class="clearfix">
				
<article id="post-236" class="post-236 post type-post status-publish format-standard hentry category-undergraduate-students">
   
   <div class="article-content clearfix">
      
      <header class="entry-header">
   		<h1 class="entry-title">Community Service Status</h1>
   	</header>
   	   	
   	<div class="entry-content clearfix">
        <script type="text/javascript" charset="utf-8">
    		var results = <?php echo json_encode($submission_results_list); ?>;
    		console.log(results.length);
    		for(let index of results) {
    			console.log(index);
			console.log(index["approved?"]);
    		}
    		
    		webix.ui({
			  rows:[
			      { view:"template", 
			        type:"header", template:"My App!" },
			      { view:"datatable", 
			        autoConfig:true, 
			        data:{
			          title:"My Fair Lady", year:1964, votes:533848, rating:8.9, rank:5
			        }
			      }
			  ]
			});
		</script>

   </div>

	</article>
			
		</div><!-- #content -->

	</div><!-- #primary -->
	</div><!-- #main -->
	
<footer id="colophon" class="clearfix">
	<div class="footer-socket-wrapper clearfix">
		<div class="inner-wrap">
			<div class="footer-socket-area">
                <div class="footer-socket-right-section">
   					<div class="social-links clearfix">
		                <ul>
		                    <li><a href="https://www.facebook.com/UDLerner/" target="_blank"><i class="fa fa-facebook"></i></a></li><li><a href="https://twitter.com/UDLernerCollege" target="_blank"><i class="fa fa-twitter"></i></a></li>		</ul>
	                </div><!-- .social-links -->
	            </div>
			</div>
		</div>
	</div>
</footer>

<script>
    const days = ["Sunday", "Monday", "Tuesday" ,"Wednesday", "Thursday", "Friday", "Saturday"];
    const monthNames = ["January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"];

   	const n =  new Date();
    const y = n.getFullYear();
    const m = n.getMonth() + 1;
    const monthName = n.getMonth();
    const d = n.getDate();
    const day = n.getDay();
    document.getElementById("header-date").innerHTML = days[day] + ", " + monthNames[monthName] + " " + d + ", " + y;
</script>
		<a href="#masthead" id="scroll-up" style="display: none;"><i class="fa fa-chevron-up"></i></a>
	</div><!-- #page -->
		</pre>

</body></html>
