<?php
if(session_id() == "")
{
        session_start();
}


class Category
{

     function __contruct()
     {
          print "In Category contructor<br>";
     }
     
     function SimilarCategoryExists($CategoryName, $CategoryID, $AccountID)
     {

          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "SELECT CategoryID FROM ".$TablePrefix."categories WHERE AccountID = ".$AccountID." AND Deleted = 0 AND CategoryID <> ".$CategoryID." AND CategoryName = '".mysql_real_escape_string($CategoryName)."'";

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
     
     function AddCategory($CategoryName, $Notes, $AccountID)
     {         

          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "INSERT INTO ".$TablePrefix."categories VALUES (0, ".$AccountID.", '".mysql_real_escape_string($CategoryName)."', '".mysql_real_escape_string($Notes)."', 0)";

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
     
     
     function EditCategory($CategoryName, $Notes, $CategoryID, $AccountID)
     {         

          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "UPDATE ".$TablePrefix."categories SET CategoryName = '".mysql_real_escape_string($CategoryName)."', Notes = '".mysql_real_escape_string($Notes)."' WHERE Deleted = 0 AND AccountID = ".$AccountID." AND CategoryID = ".$CategoryID;

          print "Query: ".$query."<p>";
          
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
     
     
     function GetCategoryDetail($CategoryID, &$CategoryName, &$CategoryNotes, $AccountID)
     {
          

          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */
          $query = "SELECT CategoryName, Notes FROM ".$TablePrefix."categories WHERE Deleted = 0 AND AccountID = ".$AccountID." AND CategoryID = ".$CategoryID;

          mysql_select_db($DatabaseName) or die("Could not select database (class.Category_GetCategoryDetail)");

          $result = mysql_query($query) or die("Query failed, please email the administrator. Err Reference: class.Category_GetCategoryDetail_1");

          if($line = mysql_fetch_row($result))
          {
               $CategoryName = $line[0];
               $CategoryNotes = $line[1];
          }
          
     
     }
     
     
     function GetCategories(&$CategoriesArray, &$ArrayCount, $AccountID)
     {

          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 
          $CategoriesArray = array();

          $query = "SELECT * FROM ".$TablePrefix."categories WHERE Deleted = 0 AND AccountID = ".$AccountID." ORDER BY CategoryName ASC";


          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (class.Category_GetCategories)");

          $result = mysql_query($query) or die("Query failed, please email the administrator. Err Reference: class.Category_GetCategories_1");

          $x = 0;
          while($line = mysql_fetch_row($result))
          { 
               $CategoriesArray[$x]['CategoryID'] = $line[0];

               $CategoriesArray[$x]['CategoryName'] = $line[2];

               $CategoriesArray[$x]['Notes'] = $line[3];

               $x++;

          }

          $ArrayCount = $x;


     }
     
     
}


?>