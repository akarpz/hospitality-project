<?php
session_start();

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
if(!isapprovedfaculty($_SESSION['cas_data']['USER'])){
    header("Location: /index.php");
}
?>
<html lang="en-US"><head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Hospitality: Community Service – myLerner</title>

<style type="text/css"></style>

<link rel="dns-prefetch" href="//maxcdn.bootstrapcdn.com">
<link rel="dns-prefetch" href="//fonts.googleapis.com">

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
                     <a href="status.php" title="View your hours to date"><i class="fa fa-user"></i></a>
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
   		<h1 class="entry-title">Community Service Internal Reporting</h1>
   	</header>
   	   	
   	<div class="entry-content clearfix">

   		<div>
            Here is where you will be able to download the current submission data as a csv
            as well as prepare a few useful reports with the simple click of the run button
            that is next to the report description.
            <br>
            <br>
            <h1>Reports</h1>
          
            <br>
            <table>
                <tr>
                    <th>Report Name</th>
                    <th>Report Description</th>
                    <th>Run Report/Download</th>
                </tr>
                <tr>
                    <td>All Data</td>
                    <td>This will download the entire database as a .csv.</td>
                    <td><button id="down_all" type="button" onclick="location.href = 'reports.php?ref=all';">Download</button></td>
                </tr>
                <tr>
                    <td>Submissions From Last Year</td>
                    <td>Download all submission data from last year</td>
                    <td><button id="down_subs_last" type="button" onclick="location.href = 'reports.php?ref= submissions_last_academic_year';">Download</button></td>
                </tr>
                <tr>
                    <td>Submissions FromvCurrent Year</td>
                    <td>Download submission data from this year</td>
                    <td><button id="down_subs_cur" type="button" onclick="location.href = 'reports.php?ref= submissions_current_academic_year';">Download</button></td>
                </tr>
                <tr>
                    <td>All Students Ranked</td>
                    <td>Download all student data ranked by hours</td>
                    <td><button id="down_stu_all" type="button" onclick="location.href = 'reports.php?ref=student_all';">Download</button></td>
                </tr>
                <tr>
                    <td>Current Year Students Ranked</td>
                    <td>Download current student data ranked by hours</td>
                    <td><button id="down_stu_cur" type="button" onclick="location.href = 'reports.php?ref=student_current';">Download</button></td>
                </tr>
                <tr>
                    <td>Previous Year Students Ranked</td>
                    <td>Download student data from last year ranked by hours</td>
                    <td><button id="down_stu_prev" type="button" onclick="location.href = 'reports.php?ref=student_previous';">Download</button></td>
                </tr>
                <tr>
                    <td>Supervisors</td>
                    <td>Download all supervisor data</td>
                    <td><button id="down_sup_all" type="button" onclick="location.href = 'reports.php?ref=supervisor_all';">Download</button></td>
                </tr>
                <tr>
                    <td>Supervisors From Current Year</td>
                    <td>Download supervisor data from this year</td>
                    <td><button id="down_sup_cur" type="button" onclick="location.href = 'reports.php?ref=supervisor_current';">Download</button></td>
                </tr>
                 <tr>
                    <td>Supervisors From Previous Year</td>
                    <td>Download supervisor data from last year</td>
                    <td><button id="down_sup_prev" type="button" onclick="location.href = 'reports.php?ref=supervisor_previous';">Download</button></td>
                </tr>
                
            </table>
            
        <div>
            <button id="redirect-button">Community Service Form</button>
        </div>
   	</div>

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

<script type="text/javascript">
    document.getElementById("redirect-button").onclick = function () {
        location.href = "studentform.php";
    };
</script>

<script>
    const days = ["Sunday", "Monday", "Tuesday" ,"Wednesday", "Thursday", "Friday", "Saturday"];
    const monthNames = ["January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"];

   	const n =  new Date();
    const y = n.getFullYear();
    const monthName = n.getMonth();
    const d = n.getDate();
    const day = n.getDay();
    document.getElementById("header-date").innerHTML = days[day] + ", " + monthNames[monthName] + " " + d + ", " + y;
</script>
		<a href="#masthead" id="scroll-up" style="display: none;"><i class="fa fa-chevron-up"></i></a>
	</div><!-- #page -->
</body></html>
