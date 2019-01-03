<?php
	//接收資料
	session_start();
	$username=$_SESSION['username'];;
	$friendusername=$_GET["friendusername"];
	$friendname=$_GET["friendname"];
	$filename=$username."_".$friendusername.".html";
	include("../mysql_connect.inc.php");
	//找自己名字
	$name_query="SELECT * FROM member_table where username = '$username'";
	$row=mysql_fetch_row(mysql_query($name_query));
	$name=$row[5];
	//找friend資料
	$friend_query="SELECT * FROM friend where name = '$username' OR name='$friendusername'";
	$result=mysql_query($friend_query);
	//都沒有資料
	if(mysql_num_rows($result)==0)
	{
		$newdata=array("data"=>array());
		$newjson=json_encode($newdata,JSON_UNESCAPED_UNICODE);
		mysql_query("INSERT INTO friend (name, friend) VALUES ('$username','$newjson')");
		mysql_query("INSERT INTO friend (name, friend) VALUES ('$friendusername','$newjson')");
		$result=mysql_query($friend_query);
	}
	//只有一個人有
	else if(mysql_num_rows($result)==1)
	{
		$newdata=array("data"=>array());
		$newjson=json_encode($newdata,JSON_UNESCAPED_UNICODE);
		$row=mysql_fetch_row($result);
		if($row[0]==$username)
			mysql_query("INSERT INTO friend (name, friend) VALUES ('$friendusername','$newjson')");
		else
			mysql_query("INSERT INTO friend (name, friend) VALUES ('$username','$newjson')");
		$result=mysql_query($friend_query);
	}
	//新增資料
	for($i=0;$i<mysql_num_rows($result);$i++)
	{
		$row=mysql_fetch_row($result);
		$namedata=$row[0];
		//判斷是誰的資料
		if($namedata==$username)
		{
			$json_old=$row[1];
			$data=json_decode($json_old);
			array_push($data->data,array("username"=>$friendusername,"name"=>$friendname,"filename"=>$filename));
			$json_new=json_encode($data,JSON_UNESCAPED_UNICODE);
			mysql_query("UPDATE friend SET friend='$json_new' where name='$username'");
		}
		else
		{
			$json_old=$row[1];
			$data=json_decode($json_old);
			array_push($data->data,array("username"=>$username,"name"=>$name,"filename"=>$filename));
			$json_new=json_encode($data,JSON_UNESCAPED_UNICODE);
			mysql_query("UPDATE friend SET friend='$json_new' where name='$friendusername'");
		}
	}
?>
<script language=JavaScript>
	parent.location.reload();
</script> 