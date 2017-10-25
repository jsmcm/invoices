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
                              <h2 class="title"><a href="#">Suppliers</a></h2>
                              <div style="clear: both;">&nbsp;</div>
                              <div class="entry">
                              
                                   <?php
                                   if(isset($_GET["Notes"]))
                                   {
                                        print "<font color=\"red\">".filter_var($_GET["Notes"], FILTER_SANITIZE_STRING)."</font>";
                                        print "<br>";
                                   }
                                   ?>
                              
                                   
                                   <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                   <tr>
                                        <td width="20%" class="TableTopBorder TableBottomBorder">
                                             <b>Supplier Name</b>
                                        </td>
                                        
                                        <td width="10%" class="TableTopBorder TableBottomBorder">
                                             <b>Telephone</b>
                                        </td>
                                             
                                        <td width="20%" class="TableTopBorder TableBottomBorder">
                                             <b>WWW</b>
                                        </td>
                                        
                                        <td width="20%" class="TableTopBorder TableBottomBorder">
                                             <b>Email</b>
                                        </td>
                                        
                                        <td width="22%" class="TableTopBorder TableBottomBorder">
                                             <b>Notes</b>
                                        </td>
                                        
                                        <td width="8%" class="TableTopBorder TableBottomBorder">
                                             &nbsp;
                                        </td>
                                        
                                   </tr>
                                   
                                                                      
                                   <?php
                                   require_once("class.Supplier.php");
                                   
                                   $NewSupplier = new Supplier();

                                   $NewSupplier->GetSuppliers($SuppliersArray, $ArrayCount, $UserID);
                                   
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
                                             print "<td>";
                                                  print "<a href=\"edit.php?SupplierID=".$SuppliersArray[$x]["SupplierID"]."\">".$SuppliersArray[$x]["SupplierName"]."</a>";
                                             print "</td>";
                                             
                                             print "<td>";
                                                  print $SuppliersArray[$x]["Telephone"];
                                             print "</td>";
                                             
                                             print "<td>";
                                                  print "<a href=\"".$SuppliersArray[$x]["WebAddress"]."\" target=\"_NEW\">".$SuppliersArray[$x]["WebAddress"]."</a>";                                                 
                                             print "</td>";
                                             
                                             print "<td>";
                                                  print $SuppliersArray[$x]["EmailAddress"];
                                             print "</td>";
                                             
                                             print "<td>";
                                                  print substr($SuppliersArray[$x]["Notes"], 0, 22);

                                                  if(strlen($SuppliersArray[$x]["Notes"]) > 22)
                                                  {
                                                       print " ...";
                                                  }
                                                  
                                             print "</td>";
                                             
                                             print "<td>";
                                                  print "<a href=\"delete.php?SupplierName=".$SuppliersArray[$x]["SupplierName"]."&SupplierID=".$SuppliersArray[$x]["SupplierID"]."\">[ Delete ]</a>"; 
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