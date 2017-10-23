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
                              <h2 class="title"><a href="#">Similar Invoices</a></h2>
                              <div style="clear: both;">&nbsp;</div>
                              <div class="entry">
                              
                              You have two invoices which look very similar. Please select how to proceed from the options below:
                              
                              
                              <p>Existing Invoice:
                              <br>
                              
                              <p><hr><p>
                              
                              <p>This Invoice:
                              
                              
                              <p><hr><p>
                              
                              <a href="DeleteInvoice.php?InvoiceID=<?php print $_REQUEST["SimilarInvoiceID"]; ?>"> [ DELETE THE EXISTING (OLD) INVOICE ]</a>
                              <p>
                              <a href="DeleteInvoice.php?InvoiceID=<?php print $_REQUEST["InvoiceID"]; ?>"> [ DELETE THIS (NEW) INVOICE ]</a>
                              <p>
                              <a href="index.php?Notes=keeping both invoices!"> [ KEEP BOTH INVOICES ]</a>
                              <p>
                              
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