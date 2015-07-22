<?php
include_once 'sqloperations.php';
ob_start();
session_start();
//echo  $_SESSION['Uid'];
$Uid=$_SESSION['Uid'];
$Fid=$_GET["user"];
$sqll=new sqloperations();
$sqll->addFriend($Uid,$Fid);
echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
?>