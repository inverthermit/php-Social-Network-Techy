<?php 
include_once 'sqloperations.php';
ob_start();
session_start();
//echo  $_SESSION['Uid'];
$Uid=$_SESSION['Uid'];
?>
<?php 
$Keyword=$_GET['Keyword'];
$sql=new sqloperations();
$posts=$sql->getPostsByKeywords($Keyword);
$users=$sql->getUsersByKeywords($Keyword);
?>
<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Standard Meta -->
      <title>Search Page</title>

  <link rel="stylesheet" type="text/css" href="./dist/semantic.css">
  <link rel="stylesheet" type="text/css" href="homepage.css">

  <script src="./dist/semantic.js"></script>
<meta charset="utf-8">
<script>
(function () {
  var
    eventSupport = ('querySelector' in document && 'addEventListener' in window)
    jsonSupport  = (typeof JSON !== 'undefined'),
    jQuery       = (eventSupport && jsonSupport)
      ? '/javascript/library/jquery.min.js'
      : '/javascript/library/jquery.legacy.min.js'
  ;
  document.write('<script src="' + jQuery + '"><\/script>');
}());
</script><script src="./Accordion _ Semantic UI_files/jquery.min.js"></script>


<script src="./Accordion _ Semantic UI_files/easing.min.js"></script>
<script src="./Accordion _ Semantic UI_files/highlight.min.js"></script>
<script src="./Accordion _ Semantic UI_files/highlight.languages.min.js"></script>
<script src="./Accordion _ Semantic UI_files/history.min.js"></script>
<script src="./Accordion _ Semantic UI_files/tablesort.min.js"></script>



<script src="./Accordion _ Semantic UI_files/semantic.min.js"></script>



<script src="./Accordion _ Semantic UI_files/docs.js"></script>

  
<link rel="stylesheet" type="text/css" class="ui" href="./Accordion _ Semantic UI_files/semantic.min.css">





</head>
<body >
  

      <link rel="stylesheet/less" type="text/css" href="src/definitions/modules/accordion.less">
<script src="./Accordion _ Semantic UI_files/accordion.js"></script>

<script src="./Accordion _ Semantic UI_files/less.min.js"></script>


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
                                        <div class="active item">
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
                    <a href="Settings.php" class="item">
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
                <h1>Accounts:</h1>
    <div class="ui divided list">
    <?php 
    //echo count($users);
    foreach($users as $user)
    {
    ?>
  <div class="item">
  <?php 
  if($sql->isFiend($Uid, $user->Uid))
  {
  	?>
  	<a href="DisLikePage.php?user=<?php echo $user->Uid;?>">
  	<div class="right floated compact ui button">Liked</div>
  	</a>
  	
  	<?php 
  	
  	
  }
  else 
  {
  	?>
  	<a href="LikePage.php?user=<?php echo $user->Uid;?>">
  	<div class="right floated compact green ui button">Like</div>
  	</a>
  	
  	<?php 
  }
  ?>
    
      <img class="ui avatar image" src="avatar/<?php
          $file="avatar/".$user->Uid.".bmp";
          if(file_exists($file))
          {
          	echo $user->Uid;
          }
          else 
          {
          	echo "null";
          }

          ?>.bmp">
    <div class="content">
      <a href="UserPage.php?Uid=<?php echo $user->Uid;?>" class="header"><?php 
      $u=$sql->getUserById($user->Uid);
      if($u->name!="")
      	echo $u->name;
      else
      	echo $u->Uid;
      ?></a>
    </div>
  </div>
  <?php 
    }
  ?>
</div>
                    </div></div>
            </div></div></div>

        <div class="row">
        <div class="column">
            <div class="one column stackable ui grid">
                
<div class="column">
<div class="ui segment">
    <h1>Posts:</h1>
<div class="ui link cards">
<?php /*?><?php ?>*/
//echo count($posts);
foreach($posts as $card)
{
	?>
	  <div class="card">
	<?php
	if(!$card->pic=='')
	{
		?>
		<div class="image">
      <img src="upload/<?php echo $card->Pid;?>.bmp">
    </div>
		<?php
	}
	?>
	<div class="content">
        
      <div class="header"><img class="ui tiny avatar image" src="avatar/<?php
          $file="avatar/".$card->Uid.".bmp";
          //echo $file;
          if(file_exists($file))
          {
          	echo $card->Uid;
          }
          else 
          {
          	echo "null";
          }

          ?>.bmp"><?php 
      $u=$sql->getUserById($card->Uid);
      if($u->name!="")
      echo "<a style='color: black' href='UserPage.php?Uid=".$u->Uid."' class='header'>".$u->name.":</a>";
      else
      echo "<a  style='color: black' href='UserPage.php?Uid=".$u->Uid."' class='header'>".$u->Uid."</a>";
      ?></div>
      <?php if($Uid==$card->Uid)
      	echo "<a href='DelPostPage.php?Pid=".$card->Pid."' style='float:right;'>Delete</a>";
      	?>
      
      <div class="meta">
        <span class="date">Posted at <?php echo $card->time;?></span>
      </div>
      <div class="description">
        <?php echo substr($card->content , 0 , 140);?>
      </div>
                   <div class="ui accordion">

    <div class="title">
      <i class="dropdown icon"></i>
      Show more
    </div>
    <div class="content">
     <?php echo $card->content;?>
     </div>
  </div>
    </div>
 
    <div class="extra content">
                           <div class="ui accordion">

    <div class="title">
      <i class="comment icon"></i>
      Reply(<?php 
      $r=$sql->getReplyByPid($card->Pid);
      echo count($r);
      ?>)
        </div>
    <div class="content">
      <form action="ReplyPage.php" method="post">
        <input type="text" name="content">
        <input  type="hidden" name="Pid" value="<?php echo $card->Pid;?>">
          <input type="submit" value="Reply">
        </form>
        <?php 
        if(count($r)!=0)
        {
        	?>
        	<div class="ui divided list">
        	<?php
        	foreach($r as $rep)
        	{
        		echo " <div class='item'>";
        		
        		echo "<a class='right floated compact'>".$rep->time."</a>";
        		if($Uid==$rep->Uid)
        			echo "<a href='DelReplyPage.php?Rid=".$rep->Rid."'><div class='right floated compact'>Delete</div></a>";
        		echo "<div class='content'>";
        		
        		$u=$sql->getUserById($rep->Uid);
        		if($u->name!="")
        			echo "<a href='UserPage.php?Uid=".$rep->Uid."' class='header'>".$sql->getUserById($rep->Uid)->name.":</a>";
        		else
        			echo "<a href='UserPage.php?Uid=".$rep->Uid."' class='header'>".$rep->Uid.":</a>";
        		
        		echo "<div class='description'>".$rep->content."</div></div></div>";
        	}
        	?>
        	 </div>       	
        	<?php
        }
        ?>
        
        
    </div>
  </div>
    </div>
  </div>
	
	<?php
	
}
?>


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

</body></html>