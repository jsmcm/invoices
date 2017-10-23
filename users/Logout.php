<?
session_start();
require_once("class.User.php");

global $CurrentUser;
$CurrentUser = new User();
print "First Name: ".$CurrentUser->FirstName."<br>";
print "Surname: ".$CurrentUser->Surname."<br>";
print "Email Address: ".$CurrentUser->EmailAddress."<br>";
print "Account ID: ".$CurrentUser->AccountID."<p>";

$CurrentUser->Logout();

print "First Name: ".$CurrentUser->FirstName."<br>";
print "Surname: ".$CurrentUser->Surname."<br>";
print "Email Address: ".$CurrentUser->EmailAddress."<br>";
print "Account ID: ".$CurrentUser->AccountID."<br>";

//header("Location: ../index.php"); 
//exit; 			
		
?>

