<?php
include_once 'sqloperations.php';
ob_start();
session_start();
//echo  $_SESSION['Uid'];
$Uid=$_SESSION['Uid'];
$Pid=$_GET["Pid"];
$sqll=new sqloperations();
if($sqll->getPostsByPid($Pid)->Uid!=$Uid&&$_SESSION['admin']=="no")
	echo "Hacker!You can't delete that!";
else
{
	$sqll->delPostById($Pid);
	echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
}

?>

