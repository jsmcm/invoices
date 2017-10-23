<?php

if(session_id() == "")
{
     session_start();
}

class Invoice
{

     function __contruct()
     {
          //print "In Invoice contructor<br>";
     }
     
     function SearchBySupplier($SupplierID, $AccountID, &$InvoiceArray, &$ArrayCount)
     {

          $ArrayCount = 0;
          $InvoiceArray = array();
          
          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "SELECT * FROM ".$TablePrefix."invoice WHERE AccountID = ".$AccountID." AND Deleted = 0 AND SupplierID = ".$SupplierID;

          $result = mysql_query($query) or $ErrorNumber = mysql_errno();




          while($line = mysql_fetch_row($result))
          { 
               $InvoiceArray[$ArrayCount]["InvoiceID"] = $line[0];
               $InvoiceArray[$ArrayCount]["CategoryID"] = $line[3];
               $InvoiceArray[$ArrayCount]["SupplierID"] = $line[2];
               $InvoiceArray[$ArrayCount]["InvoiceDate"] = $line[4];
               $InvoiceArray[$ArrayCount]["Amount"] = $line[5];
               $InvoiceArray[$ArrayCount++]["Reference"] = $line[6];
          }


     }
     
     
     function SearchByCategory($CategoryID, $AccountID, &$InvoiceArray, &$ArrayCount)
     {

          $ArrayCount = 0;
          $InvoiceArray = array();
          
          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "SELECT * FROM ".$TablePrefix."invoice WHERE AccountID = ".$AccountID." AND Deleted = 0 AND CategoryID = ".$CategoryID;

          $result = mysql_query($query) or $ErrorNumber = mysql_errno();




          while($line = mysql_fetch_row($result))
          { 
               $InvoiceArray[$ArrayCount]["InvoiceID"] = $line[0];
               $InvoiceArray[$ArrayCount]["CategoryID"] = $line[3];
               $InvoiceArray[$ArrayCount]["SupplierID"] = $line[2];
               $InvoiceArray[$ArrayCount]["InvoiceDate"] = $line[4];
               $InvoiceArray[$ArrayCount]["Amount"] = $line[5];
               $InvoiceArray[$ArrayCount++]["Reference"] = $line[6];
          }


     }
     
     
     function SearchByReference($Reference, $AccountID, &$InvoiceArray, &$ArrayCount)
     {

          $ArrayCount = 0;
          $InvoiceArray = array();
          
          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "SELECT * FROM ".$TablePrefix."invoice WHERE AccountID = ".$AccountID." AND Deleted = 0 AND InvoiceNumber LIKE '%".$Reference."%'";

          $result = mysql_query($query) or $ErrorNumber = mysql_errno();




          while($line = mysql_fetch_row($result))
          { 
               $InvoiceArray[$ArrayCount]["InvoiceID"] = $line[0];
               $InvoiceArray[$ArrayCount]["CategoryID"] = $line[3];
               $InvoiceArray[$ArrayCount]["SupplierID"] = $line[2];
               $InvoiceArray[$ArrayCount]["InvoiceDate"] = $line[4];
               $InvoiceArray[$ArrayCount]["Amount"] = $line[5];
               $InvoiceArray[$ArrayCount++]["Reference"] = $line[6];
          }


     }
     
     function GetInvoiceAttachements($InvoiceID, &$AttachementsArray, &$ArrayCount)
     {

          $AttachementsArray = array();
          $ArrayCount = 0;
          
          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "SELECT * FROM ".$TablePrefix."attachements WHERE TypeTableID = '".$InvoiceID."' AND Type = 'Invoice' AND Deleted = 0;";

          //print "Query: ".$query."<p>";
          
          $ErrorNumber = 0;

          $result = mysql_query($query) or $ErrorNumber = mysql_errno();

          if($ErrorNumber > 0)
          {
               $LastErrorNumber = 2000;
               $LastErrorDescription = "Undefined error occured";
               return -1;
          }

          while($line = mysql_fetch_assoc($result))
          { 
               //print "Got data...<br>";
          
               $AttachementsArray[$ArrayCount]["AttachementID"] = $line["AttachementID"];
               $AttachementsArray[$ArrayCount]["FileName"] = $line["FileName"];
               $AttachementsArray[$ArrayCount]["Title"] = $line["Title"];
               $AttachementsArray[$ArrayCount++]["Type"] = $line["Type"];
          }


     }
     
     function GetInvoiceDetail($InvoiceID, $AccountID, &$InvoiceDetailArray)
     {

          $InvoiceDetailArray = array();
          $AttachementArray = array();
          
          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "SELECT * FROM ".$TablePrefix."invoice WHERE AccountID = ".$AccountID." AND Deleted = 0 AND InvoiceID = ".$InvoiceID;

          //print "Query: ".$query."<p>";
          
          $ErrorNumber = 0;

          $result = mysql_query($query) or $ErrorNumber = mysql_errno();

          if($ErrorNumber > 0)
          {
               $LastErrorNumber = 2000;
               $LastErrorDescription = "Undefined error occured";
               return -1;
          }


          $InvoiceDetailArray["InvoiceID"] = "";
          $InvoiceDetailArray["CategoryID"] = "";
          $InvoiceDetailArray["SupplierID"] = "";
          $InvoiceDetailArray["Date"] = "";
          $InvoiceDetailArray["Amount"] = "";
          $InvoiceDetailArray["Reference"] = "";
          $InvoiceDetailArray["Notes"] = "";
     
          //print "In Loopup<br>";
          
          if($line = mysql_fetch_assoc($result))
          { 
               //print "Got data...<br>";
          
               $InvoiceDetailArray["InvoiceID"] = $line["InvoiceID"];
               $InvoiceDetailArray["CategoryID"] = $line["CategoryID"];
               $InvoiceDetailArray["SupplierID"] = $line["SupplierID"];
               $InvoiceDetailArray["Date"] = $line["InvoiceDate"];
               $InvoiceDetailArray["Amount"] = $line["Amount"];
               $InvoiceDetailArray["Reference"] = $line["InvoiceNumber"];
               $InvoiceDetailArray["Notes"] = $line["Notes"];
               
               $ArrayCount;
               $AttachementArray;
               $this->GetInvoiceAttachements($InvoiceID, $AttachementArray, $ArrayCount);
               
               //print "ArrayCount: ".$ArrayCount."<p>";
               
               $InvoiceDetailArray["AttachementCount"] = $ArrayCount;
               $InvoiceDetailArray["Attachements"] = $AttachementArray;
               
          }


     }
     
     
     
     
     
     function SimilarInvoiceExists($CategoryID, $SupplierID, $InvoiceDate, $InvoiceAmount, $InvoiceNumber, $AccountID)
     {

          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "SELECT invoiceID FROM ".$TablePrefix."invoice WHERE AccountID = ".$AccountID." AND Deleted = 0 AND CategoryID = ".$CategoryID." AND SupplierID = ".$SupplierID." AND InvoiceDate = ".$InvoiceDate." AND Amount = ".$InvoiceAmount." AND InvoiceNumber = '".$InvoiceNumber."'";

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
     
     function AddInvoice($CategoryID, $SupplierID, $InvoiceDate, $InvoiceAmount, $Reference, $Notes, $AccountID)
     {         

          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "INSERT INTO ".$TablePrefix."invoice VALUES (0, ".$AccountID.", ".$SupplierID.", ".$CategoryID.", ".$InvoiceDate.", ".$InvoiceAmount.", '".$Reference."', '".$Notes."', 0)";

          //print "Query: ".$query."<p>";
          
          $ErrorNumber = 0;

          $result = mysql_query($query) or $ErrorNumber = mysql_errno();

          if($ErrorNumber > 0)
          {
               $LastErrorNumber = 2000;
               $LastErrorDescription = "Undefined error occured";
               return -1;
          }

          return mysql_insert_id();
     }
     
     
     function EditInvoice($InvoiceID, $CategoryID, $SupplierID, $InvoiceDate, $InvoiceAmount, $Reference, $Notes, $AccountID)
     {         

          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "UPDATE ".$TablePrefix."invoice SET AccountID = ".$AccountID.", SupplierID = ".$SupplierID.", CategoryID = ".$CategoryID.", InvoiceDate = ".$InvoiceDate.", Amount = ".$InvoiceAmount.", InvoiceNumber = '".$Reference."', Notes = '".$Notes."' WHERE InvoiceID = ".$InvoiceID;

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
     
     
     
     
     
     
     function DeleteInvoice($InvoiceID, $AccountID)
     {         

          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "DELETE FROM ".$TablePrefix."invoice WHERE AccountID = ".$AccountID." AND InvoiceID = ".$InvoiceID;

          //print "Query: ".$query."<p>";
          
          $ErrorNumber = 0;

          $result = mysql_query($query) or $ErrorNumber = mysql_errno();

          if($ErrorNumber > 0)
          {
               $LastErrorNumber = 2000;
               $LastErrorDescription = "Undefined error occured";
               return -1;
          }
          
          if($this->DeleteAttachements($InvoiceID, $AccountID) > 0)
          {
               return 1;
          }
          else
          {
               return 0;
          }

     }
     
     
     
     function DeleteAttachements($InvoiceID, $AccountID)
     {         

          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "DELETE FROM ".$TablePrefix."attachements WHERE AccountID = ".$AccountID." AND TypeTableID = ".$InvoiceID;

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
     
     
}


?>