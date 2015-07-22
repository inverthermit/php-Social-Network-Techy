<?php
include_once 'sqloperations.php';
ob_start();
session_start();
//echo  $_SESSION['Uid'];
$admin=$_SESSION['admin'];
if($admin!='yes')
{
	header("location:index.html");
	exit();
}
?>
<?php 
$sql=new sqloperations();
$posts=$sql->getAllPosts();
$replies=$sql->getAllReplies();

?>
<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properities -->
  <title>Admin Page</title>

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
            
            <div class="ui green large menu">
                <a href="AdminPage.php" class="active item">
                <i class="home icon"></i> Home
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
                 location.href='AdminSearchPage.php?keyword='+s;
                 }" class="search link icon">
                    </i>
                </div>
                    </div>
                    <a class="item">
                <i class="user icon"></i> Admin
                </a>
                <div class="item">
                <a href="Logout.php">
                <div class="ui blue button">Log out</div>
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
<div class="ui tabular menu">
        <a href="AdminPage.php" class="item">
All Users
</a>
<a href="AdminPRPage.php" class="active item">
All Posts&Replies
</a>

</div>
    <div class="column">
        
     <table class="ui table">
  <thead>
    <tr>
        <th>PostID</th>
      <th>UserID</th>
      <th>Time</th>
      <th>Content</th>
        <th>Image</th>
        <th></th>
    </tr>
  </thead>
  <tbody>
  <?php 
  foreach($posts as $p)
  {
  	echo "<tr>";
  	echo "<td>".$p->Pid."</td>";
  	echo "<td><a href='AdminUserPage.php?Uid=".$p->Uid."'>".$p->Uid."</a></td>";
  	echo "<td>".$p->time."</td>";
  	echo "<td>".$p->content."</td>";
  	echo "<td><a href='upload/".$p->pic."'>See Image</a></td>";
  	echo "<td><a href='DelPostPage.php?Pid=".$p->Pid."'>Delete</a></td>";
  	echo "</tr>";
  }
  ?>
  </tbody>
</table>
             <table class="ui table">
  <thead>
    <tr>
        <th>ReplyID</th>
        <th>PostID</th>
      <th>UserID</th>
      <th>Time</th>
      <th>Content</th>
        <th></th>
    </tr>
  </thead>
  <tbody>
  <?php 
  foreach($replies as $r)
  {
  	echo "<tr>";
  	echo "<td>".$r->Rid."</td>";
  	echo "<td>".$r->Pid."</td>";
  	echo "<td><a href='AdminUserPage.php?Uid=".$r->Uid."'>".$r->Uid."</a></td>";
  	echo "<td>".$r->time."</td>";
  	echo "<td>".$r->content."</td>";
  	echo "<td><a href='DelReplyPage.php?Rid=".$r->Rid."'>Delete</a></td>";
  	echo "</tr>";
  }
  ?>
  </tbody>
</table>
        </div>
</div>
</div>
</div>

          
          </div></div></div>
        
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
