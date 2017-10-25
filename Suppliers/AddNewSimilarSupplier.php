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



     $SupplierName = filter_var($_GET["SupplierName"], FILTER_SANITIZE_STRING);
     $Telephone = filter_var($_GET["Telephone"], FILTER_SANITIZE_STRING);
     $EmailAddress = filter_var($_GET["EmailAddress"], FILTER_SANITIZE_EMAIL);
     $WebAddress = filter_var($_GET["WebAddress"], FILTER_SANITIZE_STRING);
     $Notes = "";
     
     $oSupplier->AddSupplier($SupplierName, $Telephone, $EmailAddress, $WebAddress, $Notes, $UserID);
     header("location: index.php?Notes=Supplier Added...");

?>