<?php
session_start();

require_once($_SERVER["DOCUMENT_ROOT"]."/users/class.User.php");
$User = new User();

$UserID = $User->GetAccountID();

if($UserID < 1)
{
     header("Location: /index.php");
     exit();
}

$CategoryID = 0;
if(isset($_GET["CategoryID"]))
{
	$CategoryID = intVal($_GET["CategoryID"]);
}

$SupplierID = 0;
if(isset($_GET["SupplierID"]))
{
	$SupplierID = intVal($_GET["SupplierID"]);
}

$DocumentTitle = "";
if(isset($_GET["Document_0"]))
{
	$DocumentTitle = filter_var($_GET["Document_0"], FILTER_SANITIZE_STRING);
}


$Date = date("Ymd");
$Amount = "";
$Reference = "";
$Notes = "";
$AttachementCount = 0;

$AttachementArray = array();

$InvoiceID = "";
if(isset($_REQUEST["InvoiceID"]))
{
     $InvoiceID = $_REQUEST["InvoiceID"];
}

require_once($_SERVER["DOCUMENT_ROOT"]."/invoices/class.Invoice.php");
$oInvoice = new Invoice();

$InvoiceDetailArray;
if($InvoiceID != "")
{
     $oInvoice->GetInvoiceDetail($InvoiceID, $UserID, $InvoiceDetailArray);
     
     $InvoiceID = $InvoiceDetailArray["InvoiceID"];
     $CategoryID = $InvoiceDetailArray["CategoryID"];
     $SupplierID = $InvoiceDetailArray["SupplierID"];
     $Date = $InvoiceDetailArray["Date"];
     $Amount = $InvoiceDetailArray["Amount"];
     $Reference = $InvoiceDetailArray["Reference"];
     $Notes = $InvoiceDetailArray["Notes"];
     
     $AttachementCount = $InvoiceDetailArray["AttachementCount"];
     $AttachementArray = $InvoiceDetailArray["Attachements"];
     
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

<link rel="stylesheet" type="text/css" media="all" href="../includes/styles/jsDatePick_ltr.min.css" />

<script type="text/javascript" src="../includes/javascript/jsDatePick.min.1.3.js"></script>


<script language="javascript">

function ValidateAmount(Amount)
{
     if(isNaN(Amount)) 
     {
          alert('The amount, must be numeric, eg, 123.45 - no spaces please');
          document.QuickAdd.InvoiceAmount.focus();
          return false;
     }
     
     // check if there is a fullstop...

     if(Amount.indexOf('.') > -1)
     {
          // There is a full stop"
          if(Amount.length - Amount.indexOf('.') > 3)
          {
               // too many positions after .
               Amount = Amount.substr(0, Amount.length - (Amount.length - Amount.indexOf('.') - 3));
               document.QuickAdd.InvoiceAmount.value = Amount;
          }
          else if(Amount.length - Amount.indexOf('.') < 3)
          {
               
               // too few positions after it
               if(Amount.length - Amount.indexOf('.') == 2)
               {
                    // add one 0
                    document.QuickAdd.InvoiceAmount.value = Amount + "0";
               }
               else if(Amount.length - Amount.indexOf('.') == 1)
               {
                    // Add two 0
                    document.QuickAdd.InvoiceAmount.value = Amount + "00";
               }
               
          }
     
     }
     else
     {
          // There is no full stop
          document.QuickAdd.InvoiceAmount.value = Amount + ".00";
     }
     
     return true;
}



var TotalItems = 0;
function AddItems(items) 
{

     items++;
     
     if(TotalItems < items)
     {
     
          TotalItems = items;
          


     
          var container = document.getElementById("AddClientBoxes");

          
          var newitem="<td>";
                newitem+="<input type=\"file\" name=\"SupportingDocumentation[]\" onchange=\"AddItems(" + items + ");\">";
           newitem+="</td>";
           
          newitem+="<td>";
                newitem+="<input type=\"text\" name=\"DocumentTitle[]\">";
           newitem+="</td>";

     
          newnode = document.createElement("tr");
          newnode.innerHTML = newitem;
               container.appendChild(newnode);
          //alert(container.innerHTML);
          //alert(newitem);
          //container.innerHTML = container.innerHTML + newitem;
          //alert(container.innerHTML);
          
          NewContactGroups = NewContactGroupsBuffer;
     
          
     }
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
                              <h2 class="title"><a href="#">Quick Add</a></h2>
                              <div style="clear: both;">&nbsp;</div>
                              <div class="entry">
                              
                                   <?php
                                   //print "UserID: ".$UserID."<p>";
                                   if(isset($_REQUEST["Notes"]))
                                   {
                                        print "<font color=\"red\">".$_REQUEST["Notes"]."</font>";
                                        print "<br>";
                                   }
                                   ?>
                              
                                   <form name="QuickAdd" method="post" enctype="multipart/form-data" action="QuickAdd.php">
                                   <input type="hidden" name="InvoiceID" value="<?php print $InvoiceID; ?>">
                                   <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                   <tr>
                                        <td width="25%">
                                             <b>Category</b>
                                        </td>
                                        
                                        <td width="25%">
                                             <b>Supplier</b>
                                        </td>
                                        
                                        <td width="15%">
                                             <b>Date</b>
                                        </td>
                                        
                                        <td width="15%">
                                             <b>Amount</b>
                                        </td>
                                        
                                        <td width="20%">
                                             <b>Reference</b>
                                        </td>
                                   </tr>
                                   
                                   <tr>
                                        <td>
                                        
                                             <?php
                                             require_once($_SERVER["DOCUMENT_ROOT"]."/users/class.User.php");
                                             require_once($_SERVER["DOCUMENT_ROOT"]."/Categories/class.Category.php");
                                             
                                             $User = new User();
                                             $Category = new Category();
                                             
                                             $Category->GetCategories($CategoriesArray, $ArrayCount, $User->GetAccountID());
                                             
                                             print "<select name=\"CategoryID\" style=\"width:120px;\">";
                                             for($x = 0; $x < $ArrayCount; $x++)
                                             {
                                                  print "<option value=\"".$CategoriesArray[$x]["CategoryID"]."\"";
                                                  
                                                  if($CategoryID == $CategoriesArray[$x]["CategoryID"])
                                                  {
                                                       print " selected ";
                                                  }
                                                  
                                                  print ">".$CategoriesArray[$x]["CategoryName"];
                                             }
                                             print "</select>";
                                             
                                             ?>
                                             
                                        </td>
                                        
                                        <td>
                                             <?
                                             require_once($_SERVER["DOCUMENT_ROOT"]."/users/class.User.php");
                                             require_once($_SERVER["DOCUMENT_ROOT"]."/Suppliers/class.Supplier.php");
                                             
                                             $User = new User();
                                             $Supplier = new Supplier();
                                             
                                             $Supplier->GetSuppliers($SuppliersArray, $ArrayCount, $User->GetAccountID());
                                             
                                             print "<select name=\"SupplierID\" style=\"width:120px;\">";
                                             for($x = 0; $x < $ArrayCount; $x++)
                                             {
                                                  print "<option value=\"".$SuppliersArray[$x]["SupplierID"]."\"";
                                                  
                                                  if($SupplierID == $SuppliersArray[$x]["SupplierID"])
                                                  {
                                                       print " selected ";
                                                  }
                                   
                                                  print ">".$SuppliersArray[$x]["SupplierName"];
                                             }
                                             print "</select>";
                                             
                                             ?>
                                        </td>
                                        
                                        <td>
                                             <input type="text" name="InvoiceDate" id="InvoiceDate" style="width:105px" value="<? print $Date; ?>" onfocus="javascript:new JsDatePick({useMode:2,target:'InvoiceDate',dateFormat:'%Y%m%d'});">
                                        </td>
                                                                                
                                        <td>
                                             <input type="text" value="<?php print $Amount; ?>" name="InvoiceAmount" id="InvoiceAmount" style="width:105px" onblur="return ValidateAmount(this.value); return false;" >
                                        </td>
                                                                                
                                        <td>
                                             <input type="text" name="Reference" value="<?php print $Reference; ?>" style="width:105px">
                                        </td>
                                   </tr>
                                   </table>
     
                              
                              
                              <?php
                                   if($AttachementCount > 0)
                                   {
                                        print "<p><hr><p>";
               
                                        for($x = 0; $x < $AttachementCount; $x++)
                                        {
                                             print "Invoice File =>".$AttachementArray[$x]["AttachementID"]." - <a href=\"../UploadedDocuments/".$AttachementArray[$x]["FileName"]."\" target=\"_NEW\">".$AttachementArray[$x]["Title"]."</a> - "
                                             .$AttachementArray[$x]["Type"]."<br>";
                                             
               
                                        }
                                        
                                        print "<p><hr><p>";
                                        
                                   }    
                              ?>
                              
                              <p>&nbsp;<p>
                              
                              <H3>Upload Invoice(s)</h3><i>You can upload any invoices for storage here (can be downloaded at any time)</i><br>
                              <p>
                              <table width=100% border="0">
                              <?
                              
                              print "<tr>";
                              print "<td width=\"50%\">";
                                   print "<b>Upload File</b>";
                              print "</td>";
                              print "<td width=\"50%\">";
                                   print "<b>File Name";
                              print "</td>";
                              print "</tr>";
                                   
                              print "<tbody id=\"AddClientBoxes\" name=\"AddClientBoxes\">";
                                   
                                   print "<tr>";
                                   print "<td>";
                                        print "<input type=\"file\" name=\"SupportingDocumentation[]\" onchange=\"AddItems(0);\">";
                                   print "</td>";
                                   print "<td>";
                                        print "<input type=\"text\" name=\"DocumentTitle[]\" value=\"".$DocumentTitle."\">";
                                   print "</td>";
                                   print "</tr>";
                                   
                                   
                                   
                              print "</tbody>";
                              ?>
                              </table>
                              
                              
                                   <p>&nbsp;<p>
                         
                                   <H2>Notes</h2><i>optional</i><br>
                                   <textarea name="Notes"><?php print $Notes; ?></textarea>
                                   
                                   <p>&nbsp;<p>
                                   
                                   <?php
                                   $ButtonText = "Add Payment";
                                   if($InvoiceID != "")
                                   {
                                        $ButtonText = "Edit Invoice";
                                   }
                                   ?>

                                   <input name="SubmitButton" type="submit" value="<?php print $ButtonText; ?>" onclick="return ValidateAmount(document.QuickAdd.InvoiceAmount.value); return false;">
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
