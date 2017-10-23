<?
session_start();

if($_SESSION["AccountID"] <= 0)
{
    //print "Redirecting... ".$_SESSION["AccountID"]."<p>";
    $_SESSION["AccountID"] = 0;
    header("Location: index.php"); 
    exit; 	
}

include("../includes/Variables.inc"); 



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Regeneracy   
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20100529

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>easyCMSlite.com | Dashboard</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="wrapper">
	<div id="header-wrapper">
		<div id="header">
			<div id="logo">
				<h1><a href="#">easyCMSlite.com</a></h1>
				<p> the free, easy content management system</p>
			</div>
			<div id="menu">
				<ul>
				<? //include("includes/TopNav.inc"); ?>
				</ul>
			</div>
		</div>
	</div>
	<!-- end #header -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
				
					<div class="post">
						<h2 class="title"><a href="#">Editing Your Site</a></h2>
						<div class="entry">
							<p>Editing a site with easyCMSlite.com is really easy. Simply click on the <a href="/">Edit Site</a> link (also in the top navigation bar) to 
							enter the editing screens.</p>
							<p>This will take you to the main site with the Accountistrator links and with the ability to add new / edit links simply by double clicking on them. You can edit the main content by clicking on the "Edit this Page" link for
							each page</p>
							<p>If you need any help, you can visit the <a class="links" href="http://www.easycmslite.com/support/video-tutorials.php">easyCMSlite.com, video tutorials</a> for some online video tutorial links (in youtube).</p>
						</div>
					</div>
					
					<div class="post">
						<h2 class="title"><a href="#">Template Choices</a></h2>
						
						<div style="clear: both;">&nbsp;</div>
						<div class="entry">
							<p>jkjkj</p>
						</div>
					</div>

					<div style="clear: both;">&nbsp;</div>
				</div>
				<!-- end #content -->
				<div id="sidebar">
                                        <? include("includes/SideNav.inc"); ?>
                                        
				</div>
				<!-- end #sidebar -->
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
	<!-- end #page -->
</div>
<div id="footer">
	<p>Copyright (c) 2008 easyCMSlite.com. All rights reserved. Design by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>.</p>
</div>
<!-- end #footer -->
</body>
</html>
