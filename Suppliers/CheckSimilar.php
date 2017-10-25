<?php
session_start();

require_once("../users/class.User.php");
require_once("class.Supplier.php");

$oSupplier = new Supplier();
$oUser = new User();

$UserID = $oUser->GetAccountID();

if($UserID < 1)
{
     header("Location: /index.php");
     exit();
}

$ExistingSupplierName = filter_var($_GET["SupplierName"], FILTER_SANITIZE_STRING);
$ExistingSupplierID = intVal($_GET["SupplierID"]);
$ExistingTelephone = filter_var($_GET["Telephone"], FILTER_SANITIZE_STRING);
$ExistingEmailAddress = filter_var($_GET["EmailAddress"], FILTER_SANITIZE_EMAIL);
$ExistingWebAddress = filter_var($_GET["WebAddress"], FILTER_SANITIZE_STRING);


$NewSupplierID = intVal($_GET["SimilarSupplierID"]);
$NewSupplierName = "";
$NewTelephone = "";
$NewEmailAddress = "";
$NewWebAddress = "";
$NewSupplierNotes = "";

$oSupplier->GetSupplierDetail($NewSupplierID, $NewSupplierName, $NewTelephone, $NewEmailAddress, $NewWebAddress, $NewSupplierNotes, $oUser->GetAccountID());
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
                    <h1><a href="/">easyCMSlite.com</a></h1>
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
                              <h2 class="title"><a href="#">Similar Supplier Found</a></h2>
                              <div style="clear: both;">&nbsp;</div>
                              <div class="entry">
                              
                                   A similar supplier was found in the database, please review and decide on an action:
                                   
                                   <table style="border:1px solid grey;" width="85%">
                                   <tr>
                                        <td width="50%"><b>EXISTING SUPPLIER</b></td>
                                        <td width="50%"><b>NEW SUPPLIER</b></td>
                                   </tr>
                                   
                                   <tr>
                                        <td width="50%">
                                             <?php
                                             print "Name: ".$ExistingSupplierName."<br>";
                                             print "Telephone: ".$ExistingTelephone."<br>";
                                             print "Email: ".$ExistingEmailAddress."<br>";
                                             print "URL: ".$ExistingWebAddress."<p>";
                                             ?>                                       
                                        </td>
                                        <td width="50%">
                                             <?php
                                             print "Name: ".$NewSupplierName."<br>";
                                             print "Telephone: ".$NewTelephone."<br>";
                                             print "Email: ".$NewEmailAddress."<br>";
                                             print "URL: ".$NewWebAddress."<p>";    
                                             ?>                                     
                                        </td>
                                   </tr>
                                   
                                   </table>                                   
                                   
                                   
                                   <p style="font-size: 18px;"><a href="index.php">Keep existing supplier only (don't add new supplier)</a></p>
                                   <p style="font-size: 18px;"><a href="AddNewSimilarSupplier.php?SupplierName=<?php print $NewSupplierName; ?>&Telephone=<?php print $NewTelephone; ?>&EmailAddress=<?php print $NewEmailAddress; ?>&WebAddress=<?php print $NewWebAddress; ?>">Keep existing supplier and also add new supplier</a></p>
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