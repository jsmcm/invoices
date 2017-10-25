<?php
session_start();

require_once($_SERVER["DOCUMENT_ROOT"]."/users/class.User.php");
$oUser = new User();

$UserID = $oUser->GetAccountID();

if($UserID < 1)
{
     header("Location: /index.php");
     exit();
}

$SupplierName = filter_var($_GET["SupplierName"], FILTER_SANITIZE_STRING);
$SupplierID = intVal($_GET["SupplierID"]);


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
                              <h2 class="title"><a href="#">Suppliers</a></h2>
                              <div style="clear: both;">&nbsp;</div>
                              <div class="entry">
                            
                              
                                   <form name="delete_confirmed.php" method="post" action="delete_confirmed.php">
                                   
                                   <input type="hidden" name="SupplierID" value="<?php print $SupplierID; ?>">
                                   
                                   <input type="submit" value="Really delete <?php print $SupplierName; ?>?" style="width:200px;">
                                   </form>
                                   
                                   <p><a href="index.php?Notes=Supplier not deleted">No, do not delete this supplier</a></p>

                              </div>
                         </div>

                         <div style="clear: both;">&nbsp;</div>
                    </div>
                    <!-- end #content -->
          
                    <?php
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