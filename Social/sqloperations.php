<?php
include_once 'user.php';
include_once 'reply.php';
include_once 'post.php';
class sqloperations extends mysqli
{
	public $dburl="localhost:3306";
	public $dbname="root";
	public $dbpassword="root";
	public $schema="social";
	public function &login($Uid,$password)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		$result=mysql_query("select * from UserInfo where Uid='".$Uid."' and password='".$password."';");
		
		if(mysql_num_rows($result))
		{ return true; }
		else{
			return false;
		
		}
	}
	
	public function signup($username,$password)
	{
		

				$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
				if(!$con)
				{
					die('Couldn\'t connect:' .mysql_error());
				}
				mysql_select_db($this->schema,$con);
				//echo "insert into UserInfo(Uid,password) values('".$username."','".$password."');";
				mysql_query("insert into UserInfo(Uid,password) values('".$username."','".$password."');");
				

	}
	
	public function delUserById($Uid)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		mysql_query("delete from UserInfo where Uid='".$Uid."';");
	}
	
	public function &getUserById($Uid)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		$result=mysql_query("select * from UserInfo where Uid='".$Uid."';");
			$row=mysql_fetch_array($result);
			if(empty($row[0]))
			{
				//echo "getuserfalse";
				return false;
			}
			else
			{
			$user=new user();
			$user->Uid=$row["Uid"];
			$user->name=$row["name"];
			$user->gender=$row["gender"];
			$user->birthday=$row["birthday"];
			$user->introduction=$row["introduction"];
			//echo $user->birthday;
			//echo "getusertrue";
			return $user;
		
		}
	}
	
	public function &getAllUsers()
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		$result=mysql_query("select * from UserInfo;");
		
		$userArr=array();
		while($row=mysql_fetch_array($result))
		{
			$user=new user();
			$user->Uid=$row["Uid"];
			$user->name=$row["name"];
			$user->gender=$row["gender"];
			$user->birthday=$row["birthday"];
			$user->introduction=$row["introduction"];
			array_push($userArr,$user);
		}
		return $userArr;
	}
	
	public function &getUsersByKeywords($key)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		$result=mysql_query("select * from UserInfo where Uid like '%".$key."%' or name like '%".$key."%';");
		
		$userArr=array();
		while($row=mysql_fetch_array($result))
		{
			$user=new user();
			$user->Uid=$row["Uid"];
			$user->name=$row["name"];
			$user->gender=$row["gender"];
			$user->birthday=$row["birthday"];
			$user->introduction=$row["introduction"];
			array_push($userArr,$user);
		}
		return $userArr;
	}
	
	public function updateUserInfo($Uid,$name,$birthday,$introduction,$gender)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		//echo "update UserInfo set name='".$name."',birthday='".$birthday."',introduction='".$introduction."',gender='".$gender."' where Uid='".$Uid."';";
		mysql_query("update UserInfo set name='".$name."',birthday='".$birthday."',introduction='".$introduction."',gender='".$gender."' where Uid='".$Uid."';");
		
	}
	
	public function updateUserPsw($Uid,$Psw)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		//echo "insert into Post(Uid,content,time,pic) values('".$Uid."','".addslashes($content)."','".$time."','');";
		mysql_query("update UserInfo set password='".$Psw."' where Uid='".$Uid."';");
	}
	
	public function addTextPost($Uid,$content,$time)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		//$str = str_replace(array("\r\n", "\r", "\n"), "", addslashes($content));
		//echo "insert into Post(Uid,content,time,pic) values('".$Uid."','".addslashes($content)."','".$time."','');";
		mysql_query("insert into Post(Uid,content,time,pic) values('".$Uid."','".str_replace(array("\r\n", "\r", "\n\n","\n"), "<br>", addslashes($content))."','".$time."','');");
		
	}
	
	public function addPicPost($Uid,$content,$time,$pic)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		//echo "insert into Post(Uid,content,time,pic) values('".$Uid."','".addslashes($content)."','".$time."','');";
		mysql_query("insert into Post(Uid,content,time,pic) values('".$Uid."','".str_replace(array("\r\n", "\r", "\n\n", "\n"), "<br>", addslashes($content))."','".$time."','');");
		$result=mysql_query("select LAST_INSERT_ID();");
		$row=mysql_fetch_array($result);
		$Pid=$row[0];
		mysql_query("update Post set pic='".$Pid.".bmp' where Pid=".$Pid.";");
		move_uploaded_file($pic,
		"upload/" .$Pid.".bmp");
	}
	
	public function &getPersonalPostsById($Uid)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		$result=mysql_query("select * from Post where Uid='".$Uid."' order by time desc;");
		$postArr=array();
		while($row=mysql_fetch_array($result))
		{
			$post=new post();
			$post->Pid=$row["Pid"];
			$post->Uid=$row["Uid"];
			$post->content=$row["content"];
			$post->time=$row["time"];
			$post->pic=$row["pic"];
			array_push($postArr,$post);
	
		}
		return $postArr;
	}
	
	public function &getAllPosts()
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		$result=mysql_query("select * from Post order by time desc;");
		$postArr=array();
		while($row=mysql_fetch_array($result))
		{
			$post=new post();
			$post->Pid=$row["Pid"];
			$post->Uid=$row["Uid"];
			$post->content=$row["content"];
			$post->time=$row["time"];
			$post->pic=$row["pic"];
			array_push($postArr,$post);
	
		}
		return $postArr;
	}
	
	public function &getPostsById($Uid)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		$result=mysql_query("select Fid from Friend where Uid='".$Uid."'");
		$Fids;
		while($row=mysql_fetch_array($result))
		{
			$Fids=$Fids."Post.Uid='".$row["Fid"]."' or ";
		}
		$Fids=$Fids."Post.Uid='".$Uid."'";
		$result=mysql_query("select Post.Uid,Post.Pid,name,content,pic,time from Post,UserInfo where Post.Uid=UserInfo.Uid and ( ".$Fids.
		") order by time desc;");
		//echo "select Post.Uid,Post.Pid,name,content,pic,time from Post,UserInfo where Post.Uid=UserInfo.Uid and ( ".$Fids.
		") order by time desc;";
		$postArr=array();
		while($row=mysql_fetch_array($result))
		{
			$post=new post();
			$post->Pid=$row["Pid"];
			$post->Uid=$row["Uid"];
			$post->name=$row["name"];
			$post->content=$row["content"];
			$post->time=$row["time"];
			$post->pic=$row["pic"];
			//echo $post->Pid.$post->Uid.$post->name;
			array_push($postArr,$post);
		}
		return $postArr;
		
		
		
	}
	
	public function &getPostsByPid($Pid)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		$result=mysql_query("select * from Post where Pid='".$Pid."';");
	    $postArr=array();
		while($row=mysql_fetch_array($result))
		{
			$post=new post();
			$post->Pid=$row["Pid"];
			$post->Uid=$row["Uid"];
			$post->content=$row["content"];
			$post->time=$row["time"];
			$post->pic=$row["pic"];
			return $post;
		
		}
	}
	
	public function &getPostsByKeywords($key)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		$result=mysql_query("select * from Post where content like '%".$key."%' order by time desc;");
		$postArr=array();
		while($row=mysql_fetch_array($result))
		{
			$post=new post();
			$post->Pid=$row["Pid"];
			$post->Uid=$row["Uid"];
			$post->content=$row["content"];
			$post->time=$row["time"];
			$post->pic=$row["pic"];
			array_push($postArr,$post);
		
		}
		return $postArr;
	}
	
	public function delPostById($Pid)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		mysql_query("delete from Post where Pid='".$Pid."';");
	}
	
	public function addFriend($Uid,$Fid)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		mysql_query("insert into Friend values('".$Uid."','".$Fid."');");
	}
	
	public function delFriend($Uid,$Fid)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		mysql_query("delete from Friend where Uid='".$Uid."' and Fid='".$Fid."';");
	}
	
	public function &getFriendNum($Fid)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		$result=mysql_query("select * from Friend where Fid='".$Fid."';");
		return mysql_num_rows($result);
	}
	
	public function &isFiend($Uid,$Fid)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		$result=mysql_query("select * from Friend where Uid='".$Uid."' and Fid='".$Fid."';");
		$num=0;
		$num=mysql_num_rows($result);
		if($num==0)
		{ return false; }
		else{
			return true;
		}
	}

	public function addReply($Pid,$Uid,$content,$time)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		mysql_query("insert into Reply(Pid,Uid,content,time) values('".$Pid."','".$Uid."','".str_replace(array("\r\n", "\r", "\n\n", "\n"), "<br>", addslashes($content))."','".$time."');");
	}

	public function &getReplyByPid($Pid)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		$result=mysql_query("select * from Reply where Pid='".$Pid."' order by time desc;");
		$replyArr=array();
		while($row=mysql_fetch_array($result))
		{
			$reply=new reply();
			$reply->Rid=$row["Rid"];
			$reply->Pid=$row["Pid"];
			$reply->Uid=$row["Uid"];
			$reply->content=$row["content"];
			$reply->time=$row["time"];
			array_push($replyArr,$reply);
		
		}
		return $replyArr;
		
	}
	
	public function &getAllReplies()
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		$result=mysql_query("select * from Reply order by time desc;");
		$replyArr=array();
		while($row=mysql_fetch_array($result))
		{
			$reply=new reply();
			$reply->Rid=$row["Rid"];
			$reply->Pid=$row["Pid"];
			$reply->Uid=$row["Uid"];
			$reply->content=$row["content"];
			$reply->time=$row["time"];
			array_push($replyArr,$reply);
	
		}
		return $replyArr;
	
	}
	
	
	public function &getReplyByRid($Rid)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		$result=mysql_query("select * from Reply where Rid='".$Rid."';");
		//echo "select * from Reply where Rid='".$Rid."';";
		while($row=mysql_fetch_array($result))
		{
			
			$reply=new reply();
			$reply->Rid=$row["Rid"];
			$reply->Pid=$row["Pid"];
			$reply->Uid=$row["Uid"];
			$reply->content=$row["content"];
			$reply->time=$row["time"];
			return $reply;
		
		}
	}
	
	public function &getReplyByUid($Uid)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		$result=mysql_query("select * from Reply where Uid='".$Uid."' order by time desc;");
		$replyArr=array();
		while($row=mysql_fetch_array($result))
		{
			$reply=new reply();
			$reply->Rid=$row["Rid"];
			$reply->Pid=$row["Pid"];
			$reply->Uid=$row["Uid"];
			$reply->content=$row["content"];
			$reply->time=$row["time"];
			array_push($replyArr,$reply);
	
		}
		return $replyArr;
	
	}
	
	public function delReplyById($Rid)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		mysql_query("delete from Reply where Rid='".$Rid."';");
	}
	
	public function &getRepliesByKeywords($key)
	{
		$con=mysql_connect($this->dburl,$this->dbname,$this->dbpassword);
		if(!$con)
		{
			die('Couldn\'t connect:' .mysql_error());
		}
		mysql_select_db($this->schema,$con);
		$result=mysql_query("select * from Reply where content like '%".$key."%' order by time desc;");
		$postArr=array();
		while($row=mysql_fetch_array($result))
		{
			$post=new reply();
			$post->Rid=$row["Rid"];
			$post->Pid=$row["Pid"];
			$post->Uid=$row["Uid"];
			$post->content=$row["content"];
			$post->time=$row["time"];
			array_push($postArr,$post);
	
		}
		return $postArr;
	}
	
	
	
	
}


?>