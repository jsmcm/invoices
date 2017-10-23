<?php
     session_start();
     
     require_once("../users/class.User.php");
     require_once("class.Supplier.php");
     
     $NewSupplier = new Supplier();
     $User = new User();
     

     $SupplierName = $_POST["SupplierName"];
     $Telephone = $_POST["Telephone"];
     $EmailAddress = $_POST["EmailAddress"];
     $WebAddress = $_POST["WebAddress"];
     $SupplierID = $_POST["SupplierID"];
     $Notes = $_POST["Notes"];

     $SimilarSupplierID = $NewSupplier->SimilarSupplierExists($SupplierName, $SupplierID, $User->GetAccountID());
     if($SimilarSupplierID)
     {
          header("location: CheckSimilar.php?SupplierName=".$SupplierName."&SimilarSupplierID=".$SimilarSupplierID."&SupplierID=".$SupplierID);
          
     
     }
     else
     {
          if($SupplierID == -1)
          {
               $NewSupplier->AddSupplier($SupplierName, $Telephone, $EmailAddress, $WebAddress, $Notes, $User->GetAccountID());
               header("location: index.php?Notes=Supplier Added...");
          }
          else
          {
               $NewSupplier->EditSupplier($SupplierName, $Telephone, $EmailAddress, $WebAddress, $Notes, $SupplierID, $User->GetAccountID());
               header("location: index.php?Notes=Supplier edit successful...");
          }
          
          
          exit();
     }



?>