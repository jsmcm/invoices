<?php
     session_start();
     
     require_once("../users/class.User.php");
     require_once("class.Supplier.php");
     
     $NewSupplier = new Supplier();
     $oUser = new User();
     
     $UserID = $oUser->GetAccountID();
     
     if($UserID < 1)
     {
          header("Location: /index.php");
          exit();
     }

     $SupplierName = $_POST["SupplierName"];
     $Telephone = $_POST["Telephone"];
     $EmailAddress = $_POST["EmailAddress"];
     $WebAddress = $_POST["WebAddress"];
     $SupplierID = $_POST["SupplierID"];
     $Notes = $_POST["Notes"];

     $SimilarSupplierID = $NewSupplier->SimilarSupplierExists($SupplierName, $SupplierID, $UserID);
     if($SimilarSupplierID)
     {
          header("location: CheckSimilar.php?SupplierName=".$SupplierName."&Telephone=".$Telephone."&EmailAddress=".$EmailAddress."&WebAddress=".$WebAddress."&SimilarSupplierID=".$SimilarSupplierID."&SupplierID=".$SupplierID);
     }
     else
     {
          if($SupplierID == -1)
          {
               $NewSupplier->AddSupplier($SupplierName, $Telephone, $EmailAddress, $WebAddress, $Notes, $UserID);
               header("location: index.php?Notes=Supplier Added...");
          }
          else
          {
               $NewSupplier->EditSupplier($SupplierName, $Telephone, $EmailAddress, $WebAddress, $Notes, $SupplierID, $UserID);
               header("location: index.php?Notes=Supplier edit successful...");
          }
          
          
          exit();
     }



?>