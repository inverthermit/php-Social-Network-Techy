<?php
include_once 'sqloperations.php';
ob_start();
session_start();
//echo  $_SESSION['Uid'];
$Uid=$_GET["Uid"];
$sqll=new sqloperations();
if($_SESSION['admin']=="no")
	echo "Hacker!You can't delete that!";
else
{
	$sqll->delUserById($Uid);
	echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
}

?>

