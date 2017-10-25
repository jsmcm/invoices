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

     $SupplierID = intVal($_POST["SupplierID"]);
     
     $oSupplier->DeleteSupplier($SupplierID, $UserID);
     header("location: index.php?Notes=Supplier deleted successfully...");

?>