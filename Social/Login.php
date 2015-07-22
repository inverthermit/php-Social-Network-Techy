<?php
include_once 'sqloperations.php';
$username=$_POST["Username"];
$password=$_POST["Password"];
//echo "asdfawef";
//echo $username;
//echo $password;
if($username=="admin"&&$password=="admin")
{
	Session_start();
	$_SESSION['admin']="yes";
	header("location:AdminPage.php");
	exit();
}
else
{
	$sql=new sqloperations();
	$result=$sql->login($username,$password);
	if($result==false)
	{
		echo "Login Failed.";
	}
	else 
	{
		Session_start();
		$_SESSION['admin']="no";
		$_SESSION['Uid']=$username;
		//echo  $_SESSION['Uid'];
		header("location:Main.php");
	}
}

?>