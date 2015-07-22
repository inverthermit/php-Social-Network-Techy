<?php
include_once 'sqloperations.php';
ob_start();
session_start();
//echo  $_SESSION['Uid'];
$Uid=$_SESSION['Uid'];
$Rid=$_GET["Rid"];
$sqll=new sqloperations();
$uuid=new reply();
$uuid=$sqll->getReplyByRid($Rid);
echo $uuid->Rid;
if($uuid->Uid!=$Uid&&$_SESSION['admin']=="no")
{
	echo "Hacker!You can't delete that!";
}
	
else
{
$sqll->delReplyById($Rid);
echo "<script>location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
}
?>