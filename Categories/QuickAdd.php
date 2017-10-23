<?
	session_start();
	
	require_once("../users/class.User.php");
	require_once("class.Category.php");
	
	$NewCategory = new Category();
	$User = new User();
	

	$CategoryName = $_POST["CategoryName"];
	$CategoryID = $_POST["CategoryID"];
	$Notes = $_POST["Notes"];

	$SimilarCategoryID = $NewCategory->SimilarCategoryExists($CategoryName, $CategoryID, $User->GetAccountID());
	if($SimilarCategoryID)
	{
		header("location: CheckSimilar.php?CategoryName=".$CategoryName."&SimilarCategoryID=".$SimilarCategoryID."&CategoryID=".$CategoryID);
		
	
	}
	else
	{
		if($CategoryID == -1)
		{
			$NewCategory->AddCategory($CategoryName, $Notes, $User->GetAccountID());
			header("location: index.php?Notes=Category Added...");
		}
		else
		{
			$NewCategory->EditCategory($CategoryName, $Notes, $CategoryID, $User->GetAccountID());
			header("location: index.php?Notes=Category edit successful...");
		}
		
		
		exit();
	}



?>