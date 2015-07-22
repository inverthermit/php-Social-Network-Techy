<?php 
include_once 'sqloperations.php';
ob_start();
session_start();
$Uid=$_SESSION['Uid'];
$u=new user();
$sql=new sqloperations();
$u=$sql->getUserById($_SESSION['Uid']);
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properities -->
  <title>Settings</title>

  <link rel="stylesheet" type="text/css" href="./dist/semantic.css">
  <link rel="stylesheet" type="text/css" href="homepage.css">

  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
  <script src="./dist/semantic.js"></script>
  <script src="homepage.js"></script>

</head>
<body >

    <img class="ui image" src="image/header.png">
    
    <h1 class="ui center aligned header" style="background-image:'./image/header.png';">
<div class="ui teal huge header">
        <div class="book icon" style="color='white'"><br>Techy</div>
        </div>
        <br>
</h1>
    
  <div class="ui vertical segment">
      
    <div class="ui very relaxed stackable page grid">
        <div class="row">
        <div class="column">
            
            <div class="ui large menu">
                <a href="Main.php" class="item">
                <i class="home icon"></i> Home
                </a>
                <a href="MyPage.php" class="item">
                <i class="smile icon"></i> My Page
                </a>
                


                <div class="right menu">
                    <div class="item">
                <div class="ui icon input">
                <input id="search" type="text" placeholder="Search for..." >
                    <i onclick="var s=eval(document.getElementById('search')).value  ;  if(s == ''){
    alert('Please input keywords!');
  }
                 else
                 {
                 location.href='SearchPage.php?Keyword='+s;
                 }" class="search link icon">
                    </i>
                </div>
                    </div>
                    <a href="Settings.php" class="active item">
                <i class="setting icon"></i> <img class="ui mini avatar image" src="avatar/<?php
          $file="avatar/".$Uid.".bmp";
          if(file_exists($file))
          {
          	echo $Uid;
          }
          else 
          {
          	echo "null";
          }

          ?>.bmp"/>
                </a>
                <div class="item">
                    <a href="Logout.php">
                    <div class="ui button">Log out</div>
                    </a>
                
                </div>
                </div>
                </div>
            </div>
        </div>
      <div class="row">
        <div class="column">
            <div class="one column stackable ui grid">
<div class="column">
<div class="ui segment">
    <div class="column">
    <form name="input" action="Update.php" method="post" enctype="multipart/form-data">


            <h3>Username</h3>
            <input type="text" placeholder="Username" disabled="true" value="<?php echo $_SESSION['Uid'];?>"/>
        
                    <h3>Nickname</h3>
            <input type="text" placeholder="Nickname" name="name" value="<?php echo $u->name;?>"/>


        <h3>Date</h3> <input type="date" name="birthday" value="<?php echo $u->birthday;?>" />
        <div style="width: 200px;" class="field">
          <h3>Photo</h3>
          <img class="ui rounded  image" src="avatar/<?php
          $file="avatar/".$Uid.".bmp";
          if(file_exists($file))
          {
          	echo $Uid;
          }
          else 
          {
          	echo "null";
          }

          ?>.bmp"/>
          <input class="ui blue button" accept="image/*" type="file" name="file"/>
        </div>
        
        <div class="field">
            <h3>Gender</h3>
            <label ><input class="ui radio checkbox checked" type="radio" name="gender" <?php if($u->gender=="male") echo "checked";?> value="male">Male</label>
            <label><input class="ui radio checkbox checked" type="radio" name="gender"  <?php if($u->gender=="female") echo "checked";?> value="female">Female</label>
            
        </div>

        <div class="field">
            <h3>Introduction</h3>
            <textarea name="introduction"><?php echo $u->introduction;?></textarea>

        </div>
        

        <br>
        
        <center>
        
            <div class="ui buttons" >
            <input type="button" class="ui button" value="Back" onclick="history.go(-1)" />
            <div class="or"></div>
            <input type="button" class="ui button" value="History" onclick="location.reload()" />
            <div class="or"></div>
            <input type="submit" class="ui positive button" value="Submit" />
          </div>
        </center>
        
</form>
        </div>
</div>
</div>
</div>

          
        </div>
      </div>

    </div>
    </div>




  <div class="ui inverted purple footer vertical segment">
    <div class="ui stackable center aligned page grid">
      <div class="sixteen wide column">
          
        <div class="ui three column center aligned stackable grid">
          <div class="column">
              <h5 class="ui inverted header">Contact Us:</h5>
          </div>
          <div class="column">
              
      <div class="six wide column">
        
        <addr>
            Harbin Institute of Technology<br>
          92 Xidazhi Road <br>
          Nangang, Harbin <br>
        </addr>
       
      </div>
          </div>
          <div class="column">
               <p>(+86) 0451-XXXXXXX</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
