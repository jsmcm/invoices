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


<link rel="stylesheet" type="text/css" href="/includes/styles/General.css">



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
						<h2 class="title"><a href="#">Categories</a></h2>
						<div style="clear: both;">&nbsp;</div>
						<div class="entry">
						
							<?
							if(isset($_REQUEST["Notes"]))
							{
								print "<font color=\"red\">".$_REQUEST["Notes"]."</font>";
								print "<br>";
							}
							?>
						
							
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr>
								<td width="25%" class="TableTopBorder TableBottomBorder">
									<b>Category Name</b>
								</td>
								
								<td width="2%" class="TableTopBorder TableBottomBorder">
									&nbsp;
								</td>
									
								<td width="50%" class="TableTopBorder TableBottomBorder">
									<b>Category Name</b>
								</td>
								
								<td width="2%" class="TableTopBorder TableBottomBorder">
									&nbsp;
								</td>
								
								<td width="25%" class="TableTopBorder TableBottomBorder">
									&nbsp;
								</td>
								
							</tr>
							
														
							<?

							require_once("../users/class.User.php");
							require_once("class.Category.php");
							
							$NewCategory = new Category();
							$User = new User();

							$NewCategory->GetCategories($CategoriesArray, $ArrayCount, $User->GetAccountID());

							
							
							for($x = 0; $x < $ArrayCount; $x++)
							{
								if($x % 2)
								{
									$BackgroundColour = "white";
								}
								else
								{
									$BackgroundColour = "#dbecff";
								}
								
								print "<tr bgcolor=\"".$BackgroundColour."\">";
									print "<td width=\"24%\">";
										print "<a href=\"edit.php?CategoryID=".$CategoriesArray[$x]["CategoryID"]."\">".$CategoriesArray[$x]["CategoryName"]."</a>";
									print "</td>";
									
									print "<td width=\"2%\">";
										print "&nbsp;";
									print "</td>";
									
									print "<td width=\"48%\">";
										print substr($CategoriesArray[$x]["Notes"], 0, 40); 
										
										if(strlen($CategoriesArray[$x]["Notes"]) > 40)
										{
											print " ...";
										}
										
									print "</td>";
									
									print "<td width=\"2%\">";
										print "&nbsp;";
									print "</td>";
									
									print "<td width=\"24%\" align=\"right\">";
										print "<!--a href=\"delete.php?CategoryID=".$CategoriesArray[$x]["CategoryID"]."\">[ Delete ]</a-->&nbsp"; 
									print "</td>";
									
								print "</tr>";
								
							}
							?>

							</table>
	
						
					
							
							

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
