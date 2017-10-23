<?
session_start();


include("../includes/Variables.inc"); 
require_once("../includes/FunctionsAdmin.inc"); 
include("../includes/Functions.inc"); 


$Password = rand(0,9);
$Password = $Password.rand(0,9);
$Password = $Password.rand(0,9);
$Password = $Password.rand(0,9);
$Password = $Password.rand(0,9);
$Password = $Password.rand(0,9);


/* Connecting, selecting database */
$link = include($_SERVER["DOCUMENT_ROOT"]."/eclfiles/includes/DatabaseConnection.inc");
 
/* Connecting, selecting database */

mysql_select_db($DatabaseName) or die("Could not select database (1)");

$query = "UPDATE Admin SET Password = md5('".$Password."') WHERE EmailAddress = '".$_POST["Email"]."';";

//print $query;

$result = mysql_query($query) or $ErrorNumber = mysql_errno();







    //set_include_path("../");
    require("class.phpmailer.php");




    // Send Client Email
    $somecontent = $somecontent."Your login to the ".$_SERVER["SERVER_NAME"]." admin panel is:\r\nUser Name: ".$_POST["Email"]."\r\nPassword: ".$Password."\r\n\r\nPlease login at ".$_SERVER["SERVER_NAME"]."/admin using this password to change this temporary password to a new one";
    
    
    $message = $somecontent;


            
            $mail = new PHPMailer();
            
            $mail->ClearAddresses(); 
            $mail->ClearAttachments();
            
            $mail->AddReplyTo("noreply@".substr($_SERVER["SERVER_NAME"], 4), $_SERVER["SERVER_NAME"]);
            $mail->From = "noreply@".substr($_SERVER["SERVER_NAME"], 4);
            $mail->FromName = $_SERVER["SERVER_NAME"];
            
            $mail->AddAddress($_POST["Email"]);
            
            $mail->Subject = "Password Reset";
            $mail->Body = $message;
            $mail->WordWrap = 50;
            
            $mail->Send();
    


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

			</div>
		</div>
	</div>
	<!-- end #header -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
				
					<div class="post">
						<h2 class="title"><a href="#">Login Sent</a></h2>
						<div class="entry">


    <? print "An email has been sent to ".$_POST["Email"]." with a new temporary password"; ?>

<? print "<p>using timezone: ".GetTimeZone()."<p>";
print "<p>Sesion is: ".$_SESSION["TimeZone"]."<p>";
?>
                        
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

