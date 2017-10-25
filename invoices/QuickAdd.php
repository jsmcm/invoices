<?php
     session_start();
     
     
     function AddDocument($SQL)
     {         

          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $ErrorNumber = 0;

          $result = mysql_query($SQL) or $ErrorNumber = mysql_errno();

          if($ErrorNumber > 0)
          {
               $LastErrorNumber = 2000;
               $LastErrorDescription = "Undefined error occured";
               return -1;
          }

          return 1;


     }
     
     require_once("../users/class.User.php");
     require_once("class.Invoice.php");
     include($_SERVER["DOCUMENT_ROOT"]."/includes/Variables.inc.php"); 
     
     $NewInvoice = new Invoice();
     $User = new User();
     
     
     $UserID = $User->GetAccountID();
     
     if($UserID < 1)
     {
          header("Location: /index.php");
          exit();
     }
          
     $InvoiceID = "";
     $InvoiceID = trim($_POST["InvoiceID"]);
     
     $SubmitButton = trim($_POST["SubmitButton"]);

     $CategoryID = $_POST["CategoryID"];
     $SupplierID = $_POST["SupplierID"];
     $InvoiceDate = $_POST["InvoiceDate"];
     $InvoiceAmount = $_POST["InvoiceAmount"];
     $Reference = $_POST["Reference"];
     $Notes = $_POST["Notes"];


     if($InvoiceID == "")
     {
          $SimilarInvoiceID = $NewInvoice->SimilarInvoiceExists($CategoryID, $SupplierID, $InvoiceDate, $InvoiceAmount, $Reference, $User->GetAccountID());

          $ID = $NewInvoice->AddInvoice($CategoryID, $SupplierID, $InvoiceDate, $InvoiceAmount, $Reference, $Notes, $User->GetAccountID());
          //print "ID: ".$ID."<p>";
          
          $FileCount = count($_FILES["SupportingDocumentation"]['tmp_name']) - 1;
     
          for($x = 0; $x < $FileCount; $x++)
          {    
     
               $Extention = $_FILES["SupportingDocumentation"]['name'][$x];
               //print $Extention."<br>";
               $Extention = substr($Extention, strpos($Extention, '.'));
               //print $Extention."<br>";
          
               $FileName = $User->GetAccountID()."_".$ID."_".date("Ymd")."_".date("His")."_".$x."_".rand(1000,9999).$Extention;
               //print $FileName."<br>";
          
               $SQL = "INSERT INTO ".$TablePrefix."attachements VALUES (0, ".$User->GetAccountID().", ".$ID.", '".$FileName."', '".$_POST["DocumentTitle"][$x]."', 'Invoice', 0)";
               AddDocument($SQL);
          
          
               //print $_FILES["SupportingDocumentation"]['tmp_name'][$x]."<p>";
               move_uploaded_file($_FILES["SupportingDocumentation"]['tmp_name'][$x], $_FILES["SupportingDocumentation"]['name'][$x]=$_SERVER["DOCUMENT_ROOT"]."/UploadedDocuments/".$FileName );
          }
          
          if($SimilarInvoiceID > 0)
          {
               header("location: CheckSimilar.php?InvoiceID=".$ID."&SimilarInvoiceID=".$SimilarInvoiceID);
               exit();
          }
          else
          {
          $GetHeaders = "";
          $x = 0;
          foreach($_POST["DocumentTitle"] as $Document)
          {
               if($Document != "")
               {
                    $GetHeaders = $GetHeaders."&Document_".$x."=".$Document;    
               }
          }

                    header("Location: index.php?Notes=Invoice Added....&CategoryID=".$CategoryID."&SupplierID=".$SupplierID.$GetHeaders);
               exit();
          }
     
     }
     else
     {
          $ID = $NewInvoice->EditInvoice($InvoiceID, $CategoryID, $SupplierID, $InvoiceDate, $InvoiceAmount, $Reference, $Notes, $User->GetAccountID());

          if($ID > 0)
          {
          $GetHeaders = "";
          $x = 0;
          foreach($_POST["DocumentTitle"] as $Document)
          {
               if($Document != "")
               {
                    $GetHeaders = $GetHeaders."&Document_".$x."=".$Document;    
               }
          }

                    header("Location: index.php?Notes=Invoice updated....&CategoryID=".$CategoryID."&SupplierID=".$SupplierID.$GetHeaders);
               exit();
          }
          
          header("Location: index.php?Notes=Updated failed...");
     }


?>