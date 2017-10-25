<?php

if(session_id() == "")
{
        session_start();
}


class Supplier
{

     function __contruct()
     {
          print "In Supplier contructor<br>";
     }
     
     function SimilarSupplierExists($SupplierName, $SupplierID, $AccountID)
     {

          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "SELECT SupplierID FROM ".$TablePrefix."suppliers WHERE AccountID = ".$AccountID." AND Deleted = 0 AND SupplierID <> ".$SupplierID." AND SupplierName = '".mysql_real_escape_string($SupplierName)."'";

          //print "Query: ".$query."<p>";
          
          $ErrorNumber = 0;

          $result = mysql_query($query) or $ErrorNumber = mysql_errno();

          if($ErrorNumber > 0)
          {
               $LastErrorNumber = 2000;
               $LastErrorDescription = "Undefined error occured";
               return -1;
          }



          if($line = mysql_fetch_row($result))
          { 
               return $line[0];
          }
          else
          {
               return 0;
          }

     }

     function AddSupplier($SupplierName, $Telephone, $EmailAddress, $WebAddress, $Notes, $AccountID)
     {         

          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "INSERT INTO ".$TablePrefix."suppliers VALUES (0, ".$AccountID.", '".mysql_real_escape_string($SupplierName)."', '".mysql_real_escape_string($Telephone)."', '".mysql_real_escape_string($EmailAddress)."', '".mysql_real_escape_string($WebAddress)."', '".mysql_real_escape_string($Notes)."', 0)";

          //print "Query: ".$query."<p>";
          
          $ErrorNumber = 0;

          $result = mysql_query($query) or $ErrorNumber = mysql_errno();

          if($ErrorNumber > 0)
          {
               $LastErrorNumber = 2000;
               $LastErrorDescription = "Undefined error occured";
               return -1;
          }

          return 1;


     }
     
     function EditSupplier($SupplierName, $Telephone, $EmailAddress, $WebAddress, $Notes, $SupplierID, $AccountID)
     {         

          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "UPDATE ".$TablePrefix."suppliers SET SupplierName = '".mysql_real_escape_string($SupplierName)."', Telephone = '".mysql_real_escape_string($Telephone)."', EmailAddress = '".mysql_real_escape_string($EmailAddress)."', WebAddress = '".mysql_real_escape_string($WebAddress)."', Notes = '".mysql_real_escape_string($Notes)."' WHERE Deleted = 0 AND AccountID = ".$AccountID." AND SupplierID = ".$SupplierID;

          //print "Query: ".$query."<p>";
          
          $ErrorNumber = 0;

          $result = mysql_query($query) or $ErrorNumber = mysql_errno();

          if($ErrorNumber > 0)
          {
               $LastErrorNumber = 2000;
               $LastErrorDescription = "Undefined error occured";
               return -1;
          }

          return 1;


     }
     
     function DeleteSupplier($SupplierID, $AccountID)
     {         

          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "UPDATE ".$TablePrefix."suppliers SET Deleted = 1 WHERE AccountID = ".$AccountID." AND SupplierID = ".$SupplierID;

          //print "Query: ".$query."<p>";
          
          $ErrorNumber = 0;

          $result = mysql_query($query) or $ErrorNumber = mysql_errno();

          if($ErrorNumber > 0)
          {
               $LastErrorNumber = 2000;
               $LastErrorDescription = "Undefined error occured";
               return -1;
          }

          return 1;


     }     
     function GetSupplierDetail($SupplierID, &$SupplierName, &$Telephone, &$EmailAddress, &$WebAddress, &$SupplierNotes, $AccountID)
     {
          
          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (class.Supplier_GetSupplierDetail)");
          $query = "SELECT * FROM ".$TablePrefix."suppliers WHERE Deleted = 0 AND AccountID = ".$AccountID." AND SupplierID = ".$SupplierID;

          $result = mysql_query($query) or die("Query failed, please email the administrator. Err Reference: class.Supplier_GetSupplierDetail_1");

          if($line = mysql_fetch_row($result))
          {
               $SupplierName = $line[2];
               $Telephone = $line[3];
               $EmailAddress = $line[4];
               $WebAddress = $line[5];
               $SupplierNotes = $line[6];
               
          }
          
     
     }
     
     
     function GetSuppliers(&$SuppliersArray, &$ArrayCount, $AccountID)
     {
          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $SuppliersArray = array();

          $query = "SELECT * FROM ".$TablePrefix."suppliers WHERE Deleted = 0 AND AccountID = ".$AccountID." ORDER BY SupplierName ASC";


          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (class.Supplier_GetSuppliers)");

          $result = mysql_query($query) or die("Query failed, please email the administrator. Err Reference: class.Supplier_GetSuppliers_1");

          $x = 0;
          while($line = mysql_fetch_row($result))
          { 
               $SuppliersArray[$x]['SupplierID'] = $line[0];

               $SuppliersArray[$x]['SupplierName'] = $line[2];

               $SuppliersArray[$x]['Telephone'] = $line[3];
               
               $SuppliersArray[$x]['EmailAddress'] = $line[4];
               
               $SuppliersArray[$x]['WebAddress'] = $line[5];
               
               $SuppliersArray[$x]['Notes'] = $line[6];

               $x++;

          }

          $ArrayCount = $x;


     }
     
     
}


?>