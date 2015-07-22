<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properities -->
  <title>Sign Up Result</title>

  <link rel="stylesheet" type="text/css" href="./dist/semantic.css">

  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
  <script src="./dist/semantic.js"></script>
<link rel="stylesheet" type="text/css" href="kitchensink.css">
</head>
<body id="sink">
            <div class="ui grid">
<div class="one wide column">
</div>
<div class="fourteen wide column">
    <div class="demo container">
        <div class="example">
            <br>
            <h1 class="ui header"><a>Sign Up Result:</a></h1>
            <div class="ui form segment">
            <center>
 <?php 
 include_once 'sqloperations.php';
 if($_POST["username"]==''||$_POST["password"]=='')
 {
 	echo "<script>alert('Please input username and password!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
 }
 else
 {
if($_POST["password"]==$_POST["password_again"])
{
	$sql=new sqloperations();
	$result=$sql->getUserById($_POST["username"]);
	if($result==false)
	{
		//echo $_POST["username"].$_POST["password"];
		$sql->signup($_POST["username"],$_POST["password"]);
		/*
		$con=mysql_connect("localhost:3306","root","root");
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db("social",$con);
		mysql_query("insert into UserInfo(Uid,password) values('".$_POST["username"]."','".$_POST["password"]."');");
		*/
		echo "<h1 class='ui green header'>Successfully registed. Go back and log in !</h1>";
	}
	else 
	{
		echo "<h1 class='ui red header'>Username already exists. Please try another one.</h1>";
	}
	
}
else {
	echo "<h1 class='ui red header'>Two passwords are different! Failed to regist.</h1>";
}

 }



?>         

        
            <div class="ui buttons" >
            <input type="button" class="ui button" value="Back" onclick="history.go(-1)" />
            <div class="or"></div>
            <a href="index.html"><input type="button" class="ui button" value="Go to Login" /></input></a>
          </div>
        </center>
           </div>
        
        </div>
        
    </div>
    </div>
    </div>
  
</body>

</html>


