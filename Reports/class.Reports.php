<?php
if(session_id() == "")
{
     session_start();
}

class Report
{

     function __contruct()
     {
          print "In Report contructor<br>";
     }

     function MonthlyReport($StartDate, $EndDate, &$MonthlyExpenseArray, &$ArrayCount, $AccountID)
     {
          
          $MonthlyExpenseArray = array();
          
          /* Connecting, selecting database */
          include($_SERVER["DOCUMENT_ROOT"]."/includes/Variables.inc.php"); 

          $link = include($_SERVER["DOCUMENT_ROOT"]."/includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "SELECT SUM(Amount), SUBSTRING(InvoiceDate, 1, 6) FROM ".$TablePrefix."invoice WHERE InvoiceDate BETWEEN ".$StartDate." AND ".$EndDate." AND AccountID = ".$AccountID." AND Deleted = 0 GROUP BY SUBSTRING(InvoiceDate, 1, 6)";
          
          //print "<p>".$query."<p>";
          
          $ArrayCount = 0;

          $result = mysql_query($query) or $ErrorNumber = mysql_errno();
          
          while($line = mysql_fetch_row($result))
          { 
               $MonthlyExpenseArray[$ArrayCount]["Amount"] = $line[0];
               $MonthlyExpenseArray[$ArrayCount++]["Month"] = $line[1];
          }
          
     }
     
     function IndividualReport($StartDate, $EndDate, &$MonthlyExpenseArray, &$ArrayCount, $AccountID)
     {
          
          $MonthlyExpenseArray = array();
          
          /* Connecting, selecting database */
          include($_SERVER["DOCUMENT_ROOT"]."/includes/Variables.inc.php"); 

          $link = include($_SERVER["DOCUMENT_ROOT"]."/includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "SELECT * FROM ".$TablePrefix."invoice, ".$TablePrefix."categories, ".$TablePrefix."suppliers where ".$TablePrefix."invoice.Deleted = 0 AND ".$TablePrefix."categories.Deleted = 0 AND ".$TablePrefix."suppliers.Deleted = 0 AND ".$TablePrefix."invoice.SupplierID = ".$TablePrefix."suppliers.SupplierID AND ".$TablePrefix."invoice.CategoryID = ".$TablePrefix."categories.CategoryID AND InvoiceDate BETWEEN ".$StartDate." AND ".$EndDate." ORDER BY SUBSTRING(InvoiceDate, 1, 6);";
     
          //print "<p>".$query."<p>";
          
          $ArrayCount = 0;

          $result = mysql_query($query) or $ErrorNumber = mysql_errno();
          
          while($line = mysql_fetch_row($result))
          { 
               $MonthlyExpenseArray[$ArrayCount]["Amount"] = $line[5];
               $MonthlyExpenseArray[$ArrayCount]["Note"] = $line[7];
               $MonthlyExpenseArray[$ArrayCount]["InvoiceNumber"] = $line[6];
               $MonthlyExpenseArray[$ArrayCount]["InvoiceDate"] = $line[4];
               $MonthlyExpenseArray[$ArrayCount]["Supplier"] = $line[16];
               $MonthlyExpenseArray[$ArrayCount++]["Category"] = $line[11];
          }
          
     }     
     
     
     
     function CategoryReport($StartDate, $EndDate, &$MonthlyExpenseArray, &$ArrayCount, $AccountID)
     {
          
          $MonthlyExpenseArray = array();
          
          /* Connecting, selecting database */
          include($_SERVER["DOCUMENT_ROOT"]."/includes/Variables.inc.php"); 

          $link = include($_SERVER["DOCUMENT_ROOT"]."/includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "SELECT SUM(Amount), ".$TablePrefix."invoice.CategoryID, SUBSTRING(InvoiceDate, 1,6) AS Date, CategoryName FROM ".$TablePrefix."invoice, ".$TablePrefix."categories WHERE ".$TablePrefix."invoice.Deleted = 0 AND ".$TablePrefix."categories.Deleted = 0 AND ".$TablePrefix."invoice.CategoryID = categories.CategoryID  AND ".$TablePrefix."InvoiceDate BETWEEN ".$StartDate." AND ".$EndDate." GROUP BY SUBSTRING(InvoiceDate, 1,6), CategoryID;";
     
          //print "<p>".$query."<p>";
          
          $ArrayCount = 0;

          $result = mysql_query($query) or $ErrorNumber = mysql_errno();
          
          while($line = mysql_fetch_row($result))
          { 
               $MonthlyExpenseArray[$ArrayCount]["Amount"] = $line[0];
               $MonthlyExpenseArray[$ArrayCount]["Month"] = $line[2];
               $MonthlyExpenseArray[$ArrayCount++]["Category"] = $line[3];
          }
          
     }     
     
}


?>