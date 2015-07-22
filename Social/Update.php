<?php
include_once 'sqloperations.php';
ob_start();
session_start();
//echo  $_SESSION['Uid'];
$Uid=$_SESSION['Uid'];
$sqll=new sqloperations();
if(!empty($_FILES['file']['tmp_name'])){
	if ((($_FILES["file"]["type"] == "image/gif")
			|| ($_FILES["file"]["type"] == "image/jpeg")
			|| ($_FILES["file"]["type"] == "image/pjpeg")
			|| ($_FILES["file"]["type"] == "image/bmp")
			|| ($_FILES["file"]["type"] == "image/png"))
			&& ($_FILES["file"]["size"] < 20000000))
	{
		if ($_FILES["file"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
		else
		{


			move_uploaded_file($_FILES["file"]["tmp_name"],
			"avatar/" . $Uid.".bmp");
			//echo "Stored in: " . "upload/" . $_SESSION['sNo'].".bmp";

		}
	}
	else
	{
		echo "Invalid file, size should be less than 200000B. Fail to regist.";
	}
}
$name=$_POST["name"];
$birthday=$_POST["birthday"];
$introduction=$_POST["introduction"];
$gender=$_POST["gender"];
$sqll->updateUserInfo($Uid,$name, $birthday, $introduction, $gender);
header("location:Settings.php");


?>