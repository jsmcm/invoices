<?php

session_start();

require_once($_SERVER["DOCUMENT_ROOT"]."/users/class.User.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/invoices/class.Invoice.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/Categories/class.Category.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/Suppliers/class.Supplier.php");

$Invoice = new Invoice();
$User = new User();
$Category = new Category();
$Supplier = new Supplier();

$UserID = $User->GetAccountID();
     
if($_POST["SearchBy"] == "Reference")
{
     $Invoice->SearchByReference($_POST["SearchCriteria1"], $UserID, $InvoiceArray, $ArrayCount);
}
else if($_POST["SearchBy"] == "Supplier")
{
     $Invoice->SearchBySupplier($_POST["SearchCriteria1"], $UserID, $InvoiceArray, $ArrayCount);
}
else if($_POST["SearchBy"] == "Category")
{
     $Invoice->SearchByCategory($_POST["SearchCriteria1"], $UserID, $InvoiceArray, $ArrayCount);
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

<script src="/includes/javascript/sorttable.js"></script>

<script language="javascript">

function ReallyDelete(InvoiceReference)
{

     
     if(confirm("Really delete: '" + InvoiceReference + "'?"))
     {
          //alert("deleting....");
          return true;
     }
     
     //alert("keeping");
     return false;
}

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
                              <h2 class="title"><a href="#">Categories</a></h2>
                              <div style="clear: both;">&nbsp;</div>
                              <div class="entry">
                              
                              

                                   <table border="0" cellpadding="0" cellspacing="0" width="100%" class="sortable">
                                   <tr>
                                        <td width="4%" class="TableTopBorder TableBottomBorder">
                                             <b>#</b>
                                        </td>
                                        
                                        <td width="20%" class="TableTopBorder TableBottomBorder">
                                             <b>Category</b>
                                        </td>
                                        
                                        <td width="2%" class="TableTopBorder TableBottomBorder">
                                             &nbsp;
                                        </td>
                                             
                                        <td width="20%" class="TableTopBorder TableBottomBorder">
                                             <b>Supplier</b>
                                        </td>
                                        
                                        <td width="2%" class="TableTopBorder TableBottomBorder">
                                             &nbsp;
                                        </td>
                                        
                                        <td width="15%" class="TableTopBorder TableBottomBorder">
                                             <b>Date</b>
                                        </td>
                                        
                                        <td width="2%" class="TableTopBorder TableBottomBorder">
                                             &nbsp;
                                        </td>
                                        
                                        <td width="9%" class="TableTopBorder TableBottomBorder">
                                             <b>Amount</b>
                                        </td>
                                        
                                        <td width="2%" class="TableTopBorder TableBottomBorder">
                                             &nbsp;
                                        </td>
                                        
                                        <td width="12%" class="TableTopBorder TableBottomBorder">
                                             <b>Reference</b>
                                        </td>
                                        
                                        <td width="2%" class="TableTopBorder TableBottomBorder">
                                             &nbsp;
                                        </td>
                                        
                                        <td width="5%" class="TableTopBorder TableBottomBorder">
                                             &nbsp;
                                        </td>
                                        
                                        
                                        <td width="5%" class="TableTopBorder TableBottomBorder">
                                             &nbsp;
                                        </td>
                                   </tr>
                                   
                                                                      
                                   <?php
                                   $Total = 0;
                                        
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
                                                  print $x + 1;
                                             print "</td>";

                                             print "<td>";
                                                  $Category->GetCategoryDetail($InvoiceArray[$x]["CategoryID"], $CategoryName, $CategoryNotes, $UserID);
                                                  print $CategoryName;
                                             print "</td>";
                                             
                                             print "<td>";
                                                  print "&nbsp;";
                                             print "</td>";
                                             
                                             print "<td>";
                                                  $Supplier->GetSupplierDetail($InvoiceArray[$x]["SupplierID"], $SupplierName, $Telephone, $EmailAddress, $WebAddress, $SupplierNotes, $UserID);
                                                  print $SupplierName;
                                             print "</td>";
                                             
                                             print "<td>";
                                                  print "&nbsp;";
                                             print "</td>";
                                             
                                             print "<td>";
                                                  print substr($InvoiceArray[$x]["InvoiceDate"], 0, 4)."-".substr($InvoiceArray[$x]["InvoiceDate"], 4, 2)."-".substr($InvoiceArray[$x]["InvoiceDate"], 6, 2); 
                                             print "</td>";
                                             
                                             print "<td>";
                                                  print "&nbsp;";
                                             print "</td>";
                                                                 
                                             print "<td>";
                                                  print "R".$InvoiceArray[$x]["Amount"]; 
                                             $Total = $Total + $InvoiceArray[$x]["Amount"];
                                             print "</td>";
                                             
                                             print "<td>";
                                                  print "&nbsp;";
                                             print "</td>";
                                             
                                             print "<td>";
                                                  print $InvoiceArray[$x]["Reference"]; 
                                             print "</td>";
                                             
                                             print "<td>";
                                                  print "&nbsp;";
                                             print "</td>";
                                             
                                             print "<td>";
                                                  print "<a href=\"index.php?InvoiceID=".$InvoiceArray[$x]["InvoiceID"]."\" ><b>Edit</b></a>";
                                             print "</td>";
                                             
                                             print "<td>";
                                                  print "<a href=\"DeleteInvoice.php?ReturnURL=/invoices/DoSearch.php&SearchBy=".$_POST["SearchBy"]."&SearchCriteria1=".$_POST["SearchCriteria1"]."&InvoiceID=".$InvoiceArray[$x]["InvoiceID"]."\" onclick=\"return ReallyDelete('".($InvoiceArray[$x]["Reference"]?$InvoiceArray[$x]["Reference"]:$InvoiceArray[$x]["Amount"])."'); return false;\"><font color=\"red\">Delete</font></a>";
                                             print "</td>";
                                             
                                        print "</tr>";
                                        

                                   }


                                        print "</table>";
     
                                        print "<b>TOTAL: ".$Total."</b><p>";    

                                   ?>

                                   
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