<?php 
session_start();
if(!isset($_SESSION['cas_data'])){
    header("Location: http://serviceforms.lerner.udel.edu/index.php");
}
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
					                  <div class="home-icon">
                     <a href="/studentform.php" title="Submit service hours"><i class="fa fa-book"></i></a>
                  </div>
					                  <div class="home-icon">
                     <a href="status.php" title="View your hours to date"><i class="fa fa-user" aria-hidden="true"></i></a>
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
            
            Today's date: <input type="text" name="todaydate" id="form-date" readonly><br>
            First name: <input type="text" name="fname" value="<?php echo $_SESSION['cas_data']['FIRSTNAME']; ?>" readonly><br>
            Last name: <input type="text" name="lname" value="<?php echo $_SESSION['cas_data']['LASTNAME']; ?>" readonly><br>
            UDNetID: <input title="UD Email Prefix" type ="text" name="id"value="<?php echo $_SESSION['cas_data']['UDELNETID']; ?>" readonly><br>
            Student email: <input type="email" name="email"value="<?php echo strtolower($_SESSION['cas_data']['EMAIL']); ?>" readonly><br>
            Student phone: <input type="text" maxlength="14" name="studtel" id="studtel"><br>
            Major: <select name="major"> 
            <option value="HRIM">HRIM</option> 
            <option value="HSIM">HSIM</option>
            </select><br><br>
            Non-profit agency that benefited from your service:
            <input type="text" name="agency" maxlength="2000" required><br>
            Agency Website: <input type="text" name="website" maxlength="45" required><br>
            Location/address of community site:
            <input type="text" name="location" maxlength="2000" required><br>
            Date(s) of Work: <br>
            Started: <input type="text" name="workdates-start" id="workdates-start" readonly required>
            Ended: <input type="text" name="workdates-end" id="workdates-end" readonly required><br>
            Number of Hours Worked: <input type="text" name="hoursworked" id="hoursworked" maxlength="5" required><br>
            Describe your specific activities: <input type="text" name="activities" maxlength="2000" required><br>
            Describe the value in what you did for the agency/site: 
            <input type="text" name="valuesite" maxlength="2000" required><br>
            Describe the value in what this experience did for YOU (your comments 
            about the experience): <input type="text" name="valueyou" maxlength="2000" required><br>
            <b>Contact information for supervisor at community site:</b><br><br><br>
            Supervisor First Name: <input type="text" name="supfname" maxlength="45" required><br>
            Supervisor Last Name: <input type="text" name="suplname" maxlength="45" required><br>
            Supervisor Title: <input type="text" name="suptitle" maxlength="45" required><br>
            Supervisor E-Mail: <input type="text" name="supemail" maxlength="45" required><br>
            Supervisor Phone: <input type="text" name="supphone" maxlength="14" id="supphone" required><br>
            <b>Is the Supervisor a student?<b>
                <select name = "supstudent?" onchange="toggle(this)">
                    <option value="no">NO</option>
                    <option value="yes">YES</option>
                </select><br><br>
            <b>Is the Supervisor related to you?<b>
                <select name = "suprelative?" onchange="toggle(this)">
                    <option value="no">NO</option>
                    <option value="yes">YES</option>
                </select><br><br>
                <div id="rejection_div" style="display:none">
                    <b>You've selected "Yes" to one of the above questions. Please submit form with a supervisor
                        who is not a student or relative. The submit button is not be clickable.</b><br><br>
                </div>
            
          <input type="submit" value="Submit" id="studentformsubmit">
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
function toggle(el){
    var value = el.options[el.selectedIndex].value,
        div = document.getElementById('rejection_div');

    if (value === 'no') {
        div.style.display = 'none';
        document.getElementById('studentformsubmit').disabled = '';
    } else if (value === 'yes') {
        div.style.display = 'block';
        document.getElementById('studentformsubmit').disabled = 'disabled';
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
    document.getElementById("form-date").value = y + "-" + m + "-" + d;
    document.getElementById("header-date").innerHTML = days[day] + ", " + monthNames[monthName] + " " + d + ", " + y;
</script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>
<script>
$(document).ready(function() {
    $( "#workdates-start" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $("#workdates-end").datepicker({ dateFormat: 'yy-mm-dd' }); 
    $("#studtel").mask('(000) 000-0000');
    $("#supphone").mask('(000) 000-0000');
    $("#hoursworked").mask('00000');
} );
</script>

		<a href="#masthead" id="scroll-up" style="display: none;"><i class="fa fa-chevron-up"></i></a>
	</div><!-- #page -->
</body></html>
