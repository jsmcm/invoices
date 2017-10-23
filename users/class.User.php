<?php
/*********************************************************************
*********************************************************************/

if(session_id() == "")
{
        session_start();
}

class User 
{
     
     var $FirstName = '';
     var $Surname = '';
     var $AccountID = -1;
     var $AccountLevel = 0;
     var $EmailAddress = 0;
     
     var $LastErrorNumber = 0;
     var $LastErrorDescription = "";
     
     function __construct() 
     {
          if(isset($_SESSION["AccountID"]))
          {
               if($_SESSION["AccountID"] > 0)
               {
                    $this->GetAccountInfo($_SESSION["AccountID"]);
               }
          }
     }
   
     function GetAccountID()
     {
          return $this->AccountID;
     }
     
     function GetAccountInfo($AccountID)
     {
          
          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");

          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "SELECT * FROM ".$TablePrefix."accounts WHERE AccountID = ".$AccountID." AND Deleted = 0";

          //print "Query: ".$query."<p>";
          
          $ErrorNumber = 0;

          $result = mysql_query($query) or $ErrorNumber = mysql_errno();

          if($ErrorNumber == 1146)
          {
               $LastErrorNumber = 1146;
               $LastErrorDescription = "Database error while trying to log in (possibly table or database does not exist";
               exit;
          }
          else if($ErrorNumber > 0)
          {
               $LastErrorNumber = 2000;
               $LastErrorDescription = "Undefined error occured";
               exit;
          }



          if($line = mysql_fetch_row($result))
          { 
               $this->AccountID = $line[0];
               $this->AccountLevel = $line[1];
               $this->FirstName = $line[2];
               $this->Surname = $line[3];
               $this->EmailAddress = $line[4];
               
               return $this->AccountID;
          }
          else
          {
               return -1;
          }

     }
     
     function CheckLoginCredentials($EmailAddress, $Password) 
     {

          /* Connecting, selecting database */
          include("../includes/Variables.inc.php"); 

          $link = include("../includes/DatabaseConnection.inc");
     
          /* Connecting, selecting database */

          mysql_select_db($DatabaseName) or die("Could not select database (1)");

          $query = "SELECT * FROM ".$TablePrefix."accounts WHERE EmailAddress = '".$EmailAddress."' AND Password = md5('".$Password."') AND Deleted = 0;";

          $ErrorNumber = 0;

          $result = mysql_query($query) or $ErrorNumber = mysql_errno();
          
          if($ErrorNumber == 1146)
          {
               $LastErrorNumber = 1146;
               $LastErrorDescription = "Database error while trying to log in (possibly table or database does not exist";
               exit;
          }
          else if($ErrorNumber > 0)
          {
               $LastErrorNumber = 2000;
               $LastErrorDescription = "Undefined error occured";
               exit;
          }



          if($line = mysql_fetch_row($result))
          { 
               $this->AccountID = $line[0];
     
               $_SESSION["AccountID"] = $this->AccountID;

               $this->GetAccountInfo($this->AccountID);
          
               return $this->AccountID;
          }
          else
          {
          
               $this->Logout();
               return -1;
          }

     }
    
     function Logout()
     {
          $this->AccountID = -1;
          $this->AccountLevel = 0;
          $this->FirstName = "";
          $this->Surname = "";
          $this->EmailAddress = "";
          $_SESSION["AccountID"] = -1;
     }
    
}


?>
