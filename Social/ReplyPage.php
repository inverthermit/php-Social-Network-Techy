<?php
include_once 'sqloperations.php';
ob_start();
session_start();
//echo  $_SESSION['Uid'];
$Uid=$_SESSION['Uid'];
$sqll=new sqloperations();

date_default_timezone_set (PRC);
if($_POST["content"]=='')
{
	echo "<script>alert('Can\'t reply null content!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
}
else 
{
$sqll->addReply($_POST["Pid"],$Uid,$_POST["content"],date('Y-m-d H:i:s',time()));
  echo "<script>alert('Reply succeed!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
}
?>