<?php
error_reporting(E_ALL);

session_start();

require_once("class.User.php");
$CurrentUser = new User();

if($CurrentUser->CheckLoginCredentials($_POST["UserName"], $_POST["Password"]) > 0)
{
	header("location: ../invoices/index.php");
}
else
{
	header("location: lostpassword.php");
}

                        
?>

