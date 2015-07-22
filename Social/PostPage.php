<?php
include_once 'sqloperations.php';
ob_start();
session_start();
//echo  $_SESSION['Uid'];
$Uid=$_SESSION['Uid'];
$sqll=new sqloperations();
if($_POST["content"]=='')
{
	echo "<script>alert('Can\'t post null content!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
}
else
{
date_default_timezone_set (PRC);
if(!empty($_FILES['file']['tmp_name'])){
	
if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/bmp")
		|| ($_FILES["file"]["type"] == "image/png")
		|| ($_FILES["file"]["type"] == "image/ico"))
		&& ($_FILES["file"]["size"] < 20000000))
{
	if ($_FILES["file"]["error"] > 0)
	{
		echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
	}
	else
	{
		//echo $Uid.$_POST["content"].date('Y-m-d H:i:s',time()).$_FILES["file"]["tmp_name"];
		$sqll->addPicPost($Uid,$_POST["content"],date('Y-m-d H:i:s',time()),$_FILES["file"]["tmp_name"]);			
	}
	//echo date('Y-m-d H:i:s',time());
}
}
else 
{
	//echo $Uid.$_POST["content"].@date('Y-m-d H:i:s',time()).$_FILES["file"]["tmp_name"];
	$sqll->addTextPost($Uid,$_POST["content"],date('Y-m-d H:i:s',time()));	
}
header("location:Main.php");
}
?>