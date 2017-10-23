<?php
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
<title>Search</title>
<link href="../includes/styles/style.css" rel="stylesheet" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" media="all" href="../includes/styles/jsDatePick_ltr.min.css" />

<script type="text/javascript" src="../includes/javascript/jsDatePick.min.1.3.js"></script>


<script language="javascript">


</script>

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
                              <h2 class="title"><a href="#">Search</a></h2>
                              <div style="clear: both;">&nbsp;</div>
                              <div class="entry">
                              
                              <b>Search by Category</b>
                              <form action="DoSearch.php" method="post">
                              
                              <?php

                              require_once($_SERVER["DOCUMENT_ROOT"]."/users/class.User.php");
                              require_once($_SERVER["DOCUMENT_ROOT"]."/Categories/class.Category.php");
                              
                              $User = new User();
                              $Category = new Category();
                              
                              $Category->GetCategories($CategoriesArray, $ArrayCount, $User->GetAccountID());
                              
                              print "<select name=\"SearchCriteria1\" style=\"width:120px;\">";
                              print "<option value=\"-1\">Select";
                              for($x = 0; $x < $ArrayCount; $x++)
                              {
                                   print "<option value=\"".$CategoriesArray[$x]["CategoryID"]."\">".$CategoriesArray[$x]["CategoryName"];
                              }
                              print "</select>";
                              
                              ?>
                                   
                              <input name="SearchBy" value="Category" type="hidden">
                              <p>
                              <input type="submit" value="Search by Category">
                              </form>
                              
                              <p><hr style="color:black; border-width:1px; border-style:solid;"><p>
                              
                              <b>Search by Supplier</b>
                              <form action="DoSearch.php" method="post">
                              
                              <?php
                              require_once($_SERVER["DOCUMENT_ROOT"]."/users/class.User.php");
                              require_once($_SERVER["DOCUMENT_ROOT"]."/Suppliers/class.Supplier.php");
                              
                              $User = new User();
                              $Supplier = new Supplier();
                              
                              $Supplier->GetSuppliers($SuppliersArray, $ArrayCount, $User->GetAccountID());
                              
                              print "<select name=\"SearchCriteria1\" style=\"width:120px;\">";
                              print "<option value=\"-1\">Select";
                              for($x = 0; $x < $ArrayCount; $x++)
                              {
                                   print "<option value=\"".$SuppliersArray[$x]["SupplierID"]."\">".$SuppliersArray[$x]["SupplierName"];
                              }
                              print "</select>";
                              
                              ?>
                              
                              <input name="SearchBy" value="Supplier" type="hidden">
                              <p>
                              <input type="submit" value="Search by Supplier">
                                             
                              </form>
                              
                              <p><hr style="color:black; border-width:1px; border-style:solid;"><p>
                              
                              <b>Search by Reference / Invoice Number</b>
                              <form action="DoSearch.php" method="post" name="Reference">
                              
                              <input type="text" name="SearchCriteria1">
                              <input name="SearchBy" value="Reference" type="hidden">
                              <p>
                              <input type="submit" value="Search by Reference" onclick="javascript:if(document.Reference.SearchCriteria1.value==''){return false;}else{return true;}; return false;">
                              
                              </form>
                              
                              <p><hr style="color:black; border-width:1px; border-style:solid;"><p>
                              
                                   

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