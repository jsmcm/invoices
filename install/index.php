<?
session_start();

include("../includes/functions.common.inc"); 

print "<html>";
print "<body style=\"font-family:arial; font-size:12px;\">";

if(CheckForVariablesFile() == 0)
{
	print "<font color=\"red\" size=\"4\">ERROR! No Variables.inc file found in the includes folder<br>";
	print "I have created a default one, but you must first put values into it before continuing</font>";
	print "</body>";
	print "</html>";
	exit();
}

include("../includes/Variables.inc");


// Add tables here
$TableNames[0][0] = "Accounts";
$TableNames[0][1] = "AccountID int(11) auto_increment primary key, AccountLevel int(3), FirstName tinytext, Surname tinytext, EmailAddress tinytext, Password tinytext, Deleted int(1)";

$TableNames[1][0] = "Categories";
$TableNames[1][1] = "CategoryID int(11) auto_increment primary key, AccountID int(11), CategoryName tinytext, Notes text, Deleted int(1)";

$TableNames[2][0] = "Invoice";
$TableNames[2][1] = "InvoiceID int(6) auto_increment primary key, AccountID int(11), SupplierID int(11), CategoryID int(11), InvoiceDate int(8), Amount decimal(15,2), InvoiceNumber tinytext, Notes text, Deleted int(1)";

$TableNames[3][0] = "Suppliers";
$TableNames[3][1] = "SupplierID int(6) auto_increment primary key, AccountID int(11), SupplierName tinytext, Telephone tinytext, EmailAddress tinytext, WebAddress tinytext, Notes text, Deleted int(1)";

$TableNames[4][0] = "Attachements";
$TableNames[4][1] = "AttachementID int(6) auto_increment primary key, AccountID int(11), TypeTableID int(11), FileName tinytext, Title tinytext, Type tinytext, Deleted int(1)";



$ErrorValues = "";


print "Checking and installing tables<p>";


/* Connecting, selecting database */
$link = include("../includes/DatabaseConnection.inc");
 
/* Connecting, selecting database */

mysql_select_db($DatabaseName) or die("<font color=\"red\">Could not select database (".$DatabaseName.")<p>Installation aborted, please create the database first. Also, create a user for the database and change the settings in the file /includes/Variables.inc</font>");

for($x = 0; $x < sizeof($TableNames); $x++)
{
    
    $query = "SELECT * FROM ".$TablePrefix.$TableNames[$x][0].";";
    
    //echo $query;
    
    $ErrorNumber = 0;
    
    $result = mysql_query($query) or $ErrorNumber = mysql_errno();
    
    if($ErrorNumber == 1146)
    {
        //print "<p>Creating Table <b>".$TablePrefix.$TableNames[$x][0]."</b><br>";
        $query = "CREATE TABLE ".$TablePrefix.$TableNames[$x][0]." (".$TableNames[$x][1].");";
        
	//print "Query: ".$query."<p>";

        $ErrorNumber = 0;
        
        $result = mysql_query($query) or $ErrorNumber = mysql_errno();
        
        //print "ErrorNumber " . $ErrorNumber."<p>";
        
        if(mysql_errno() > 0)
        {
            print "There is a problem creating the database structure, please contact the web administrator for assistance";
            exit;
        }
        else
        {
            print "Table <b>".$TablePrefix.$TableNames[$x][0]."</b> created successfully<br>";
        }
        
    }
    else if($ErrorNumber > 0)
    {
        $ErrorValues = $ErrorValues."Cannot check table <b>".$TableNames[$x][0]."</b>, please let the administrator know (".$ErrorNumber.")<p>&nbsp;<p>";
    }
    
    else
    {
        print "Table <b>".$TablePrefix.$TableNames[$x][0]."</b> already exists<br>";
    }
 
}

if($ErrorValues)
{
	print "<font color=\"red\"><b>There were errors, please report them to us at easycmslite.com:</b><p>".$ErrorValues."<p>&nbsp;<p>";
	exit();
} 

print "<p>Database structure created successfully";
	
exit();
?>
