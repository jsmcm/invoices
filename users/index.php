<?
session_start();
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
<title>easyCMSlite.com | Login</title>
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

			</div>
		</div>
	</div>
	<!-- end #header -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
					<div class="post">
						<h2 class="title"><a href="#">Administrator Login</a></h2>
						<div style="clear: both;">&nbsp;</div>
						<div class="entry">
						
							<form name="AdminLogin" method="post" action="CheckLogin.php">
							User Name:
							<br>
							<input type="text" name="UserName">
							<p> 
							Password:
							<br>
							<input type="Password" name="Password">
							<p>
							<input type="submit">
							</form>
							<br>
							<a href="lostpassword.php">Lost Password</a>
				

						</div>
					</div>

					<div style="clear: both;">&nbsp;</div>
				</div>
				<!-- end #content -->
				<div id="sidebar">
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
