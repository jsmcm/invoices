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
<link href="../includes/styles/style.css" rel="stylesheet" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" media="all" href="../includes/styles/jsDatePick_ltr.min.css" />

<script type="text/javascript" src="../includes/javascript/jsDatePick.min.1.3.js"></script>


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
						<h2 class="title"><a href="#">Reports</a></h2>
						<div style="clear: both;">&nbsp;</div>
						<div class="entry">
						
							<?
							if(isset($_REQUEST["Notes"]))
							{
								print "<font color=\"red\">".$_REQUEST["Notes"]."</font>";
								print "<br>";
							}
							?>
						
							<form name="Reports" method="post" action="ReportGen.php">
							
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td width="25%">
									<b>Start Date</b>
								</td>
								
								<td width="25%">
									<b>End Date</b>
								</td>
								
								<td width="25%">
									<b>Type</b>
								</td>

								<td width="*">
									&nbsp;
								</td>
							</tr>
							
							<tr>
							
								<td>
									<input type="text" name="StartDate" id="StartDate" style="width:105px" value="<? print date("Ymd") - 10000 ?>" onfocus="javascript:new JsDatePick({useMode:2,target:'StartDate',dateFormat:'%Y%m%d'});">
								</td>
																
								<td>
									<input type="text" name="EndDate" id="EndDate" style="width:105px" value="<? print date("Ymd") ?>" onfocus="javascript:new JsDatePick({useMode:2,target:'EndDate',dateFormat:'%Y%m%d'});">
								</td>
								
								<td>
									<select name="ReportType">
										<option value="Monthly">Summary</option>
										<option value="Category">Category</option>
										<option value="Individual">Individual</option>
									</select>
								<td>
									<input type="submit" value="Draw Reports">
								</td>
							</tr>
							</table>

							</form>
							

						</div>
					</div>

					<div style="clear: both;">&nbsp;</div>
				</div>
				<!-- end #content -->


				<?
				include($_SERVER["DOCUMENT_ROOT"]."/includes/SideNav.inc");
				?>
				
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
