<?php
     session_start();

     require_once("../users/class.User.php");
     require_once("class.Invoice.php");
     
     $Invoice = new Invoice();
     $User = new User();
     
     $ReturnURL = "";
     if(isset($_REQUEST["ReturnURL"]))  
     {
          $ReturnURL = trim($_REQUEST["ReturnURL"]);
     }
     
     $SearchBy = "";
     if(isset($_REQUEST["SearchBy"]))   
     {
          $SearchBy = trim($_REQUEST["SearchBy"]);
     }

     $SearchCriteria1 = "";
     if(isset($_REQUEST["SearchCriteria1"])) 
     {
          $SearchCriteria1 = trim($_REQUEST["SearchCriteria1"]);
     }

     $InvoiceID = $_REQUEST["InvoiceID"];
     $AccountID = $User->GetAccountID();

     $Notes = "";
     if($Invoice->DeleteInvoice($InvoiceID, $AccountID) > 0)
     {
          $Notes = "Invoice Deleted...";
     }
     else
     {
          $Notes = "Invoice NOT Deleted...";
     }
     
     if($ReturnURL != "")
     {
          print "<form name=\"ReturnForm\" action=\"".$ReturnURL."\" method=\"POST\">";
          print "<input type=\"hidden\" name=\"SearchCriteria1\" value=\"".$_REQUEST["SearchCriteria1"]."\">";
          print "<input type=\"hidden\" name=\"SearchBy\" value=\"".$_REQUEST["SearchBy"]."\">";
          print "<input type=\"submit\" value=\"Click here if not automatically redirected\">";
          print "</form>";

          print "<script language=\"javascript\">";
          print "document.ReturnForm.submit();";
          print "</script>";
     }
     else
     {
          header("Location: ./index.php?Notes=".$Notes);
     }

     exit();
     


?>