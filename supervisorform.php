<?php
include 'supervisordbselect';
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
   		<h1 class="entry-title">Community Service Form</h1>
   	</header>
   	   	
   	<div class="entry-content clearfix">
        <form action="/form_submission.php" method="post">
   	        
   	        Today's Date: <input type="text" name="todaydate" id="form-date" readonly><br>
   	        Student First Name: <input type="text" name="fname"><br>
            Student Last Name: <input type="text" name="lname"><br>
            Student E-Mail: <input type="email" name="email"><br>
            Student ID: <input type ="text" name="id"><br>
            Student major: HRIM or HSIM: <input type="text" name="major"><br>
            Organization: <input type="text" name="organization"><br>
            Agency Website: <input type="text" name="website"><br>
            Location/address of community site:
            <input type="text" name="location"><br>
            Non-profit agency that benefited from student service:
            <input type="text" name="agency"><br>
            Date(s) of work: <br>
            Started: <input type="date" name="workdates-start"><br>
            Ended: <input type="date" name="workdates-end"><br>
            Number of hours worked: <input type="text" name="numberhours"><br>
            Student description of his/her specific activities: <input type="text" name="activities"><br>
            Student description of the value that he/she provided to your agency/site: 
            <input type="text" name="valuesite"><br>
            Student description of what this experience did for him/her: <input type="text" name="valueyou"><br>
            <b>Please fill out the few fields below if the student's responses 
            are descriptive of the services he/she provided. 
            Otherwise you may contact the student to explain
            what about their submission you disagree with:</b><br><br>
            Supervisor Name: <input type="text" name="supname"><br>
            Supervisor Title: <input type="text" name="suptitle"><br>
            Supervisor E-mail: <input type="text" name="supemail"><br>
            Supervisor Phone: <input type="text" name="supphone"><br>
            <b>Are you a student at UD?<b>
                <select>
                    <option value="yes">YES</option>
                    <option value="no">NO</option>
                </select><br><br>
            <b>Are you related to the student who sent you this form?<b>
                <select>
                    <option value="yes">YES</option>
                    <option value="no">NO</option>
                </select><br><br>
            <b>If  you answer yes to the above question(s), understand that the student will not be awareded
            community service hours<b><br><br>
            
            <!-- Signature of Student: <input type="text" name="supsig"><br> -->
            <b>If all of the above information reflects your recolection of the services rendered
            by the student volunteer, please press submit to confirm their community service hours</b>
            <br><br>
            
            
          <input type="submit" value="Submit">
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
    const days = ["Sunday", "Monday", "Tuesday" ,"Wednesday", "Thursday", "Friday", "Saturday"];
    const monthNames = ["January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"];

   	const n =  new Date();
    const y = n.getFullYear();
    const m = n.getMonth() + 1;
    const monthName = n.getMonth();
    const d = n.getDate();
    const day = n.getDay();
    document.getElementById("form-date").value = m + "/" + d + "/" + y;
    document.getElementById("header-date").innerHTML = days[day] + ", " + monthNames[monthName] + " " + d + " " + y;
</script>
		<a href="#masthead" id="scroll-up" style="display: none;"><i class="fa fa-chevron-up"></i></a>
	</div><!-- #page -->
</body></html>
