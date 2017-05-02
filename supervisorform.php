<?php

$servername = "localhost";
$username = "root";
$password = "=76_kill_COMMON_market_8=";
$db_name = "hospitality-serviceform-db";

$conn = new mysqli($servername, $username, $password, $db_name);

$ref = $_GET["ref"];

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!($submission_lookup = $conn->prepare("Select sub.Submission_ID, sub.Agency_Address, sub.Non_Profit_Benefactor, sub.Start_Date_Work, sub.End_Date_Work, sub.Hours_Worked, 
                                            sub.Activity_Description, stu.First_Name, stu.Last_Name, stu.Student_Email FROM Submission sub JOIN Student_Submissions ss 
                                            ON sub.Submission_ID=ss.Submission_ID and sub.Supervisor_Form_Link=? JOIN Student stu ON stu.UDID=ss.UDID;"))) {
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
}

if (!$submission_lookup->bind_param("s", $ref)) {
    echo "Binding parameters failed: (" . $conn->errno . ") " . $conn->error;
}

if (!$submission_lookup->execute()) {
    echo "Execute failed: (" . $conn->errno . ") " . $conn->error;
}

if(!$submission_lookup->bind_result($sub_id, $address, $agency, $startdate, $enddate, $hours, $description, $fname, $lname, $email)) {
    echo "Bind Result failed: (" . $conn->errno . ") " . $conn->error;
}

if(!$submission_lookup->fetch()) {
    echo "Fetch failed: (" . $conn->errno . ") " . $conn->error;
}

$submission_lookup->close();

$conn->close();

?>

<html lang="en-US"><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Hospitality: Community Service – myLerner</title>

<style type="text/css"></style>

<link rel="dns-prefetch" href="//maxcdn.bootstrapcdn.com">
<link rel="dns-prefetch" href="//fonts.googleapis.com">
<link rel="dns-prefetch" href="//s.w.org">

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
   		<h1 class="entry-title">Community Service Verification</h1>
   		<b>You are seeing this page because a University of Delaware student
   		completed community service for you, and in order to have those hours approved, you must certify
   		the authenticity of their serivce. Please review the prefilled fields below that display
   		student responses. If the fields honestly reflect the the student's service, please fill out 
   		the three  fields at the bottom and click submit.</b>
   		<br><br>
   		
   	</header>
   	   	
   	<div class="entry-content clearfix">
        <form action="/supervisor_submission.php" method="post">
        
            <input type="hidden" name="sub_id" value="<?php echo $sub_id; ?>"> 
   	        Student Name: <input type="text" name="studname" value="<?php echo $fname . " " . $lname; ?>" readonly><br>
            Student E-Mail: <input type="email" name="email" value="<?php echo $email; ?>" readonly><br>
            Location/address of community site:
            <input type="text" name="location" value="<?php echo $address; ?>" readonly><br>
            Non-profit agency that benefited from student service:
            <input type="text" name="agency" value="<?php echo $agency; ?>" readonly><br>
            Date(s) of work: <br>
            Started: <input type="date" name="workdates-start" value="<?php echo $startdate; ?>" readonly><br>
            Ended: <input type="date" name="workdates-end" value="<?php echo $enddate; ?>" readonly><br>
            Number of hours worked: <input type="text" name="numberhours" value="<?php echo $hours; ?>" readonly><br>
            Student description of his/her specific activities: <input type="text" name="activities" value="<?php echo $description; ?>" readonly><br>
            <b>Please fill out the few fields below if the student's responses 
            are descriptive of the services he/she provided. 
            Otherwise you may contact the student to explain
            what about their submission you disagree with:</b><br><br>
            Your Name: <input type="text" name="supname"><br>
            <b>Is the Supervisor a student or relative?<b>
                <select name = "supstudent?" id="supstudent" onchange="toggle(this)">
                    <option value="no" selected>NO</option>
                    <option value="yes">YES</option>
                </select><br><br>
                <div id="rejection_div" style="display:none">
                    <b>You've selected "Yes" to one of the above questions. Please submit form with a supervisor
                        who is not a student or relative. The submit button is not be clickable.</b><br><br>
                </div>
            
            <!-- Signature of Student: <input type="text" name="supsig"><br> -->
            <b>If all of the above information reflects your recolection of the services rendered
            by the student volunteer, please press submit to confirm their community service hours.</b>
            <br><br>
            
            
          <input type="submit" value="Submit" id="supformsubmit">
        </form>

   </div>

	</article>
			
		</div><!-- #content -->

		<ul class="default-wp-page clearfix">
			<li class="previous"><a href="http://my.lerner.udel.edu/undergraduate-students/undergraduate-advising" rel="prev"><span class="meta-nav">←</span> Advising</a></li>
			<li class="next"><a href="http://my.lerner.udel.edu/undergraduate-students/undergraduate-advising/senior-check-out" rel="next">Senior Check-out <span class="meta-nav">→</span></a></li>
		</ul>

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
    function toggle(el) {
    var value = el.options[el.selectedIndex].value,
        div = document.getElementById('rejection_div');

    if (value === 'no') {
        div.style.display = 'none';
        document.getElementById('supformsubmit').disabled = '';
    } else if (value === 'yes') {
        div.style.display = 'block';
        document.getElementById('supformsubmit').disabled = 'disabled';
    }
}
</script>
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
</body></html>
