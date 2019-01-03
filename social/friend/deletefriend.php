<?php
	//接收資料
	session_start();
	$username=$_SESSION['username'];;
	$friendusername=$_GET["friendusername"];
	include("../mysql_connect.inc.php");
	//找自己資料
	$friend_query="SELECT * FROM friend where name = '$username'";
	$result=mysql_query($friend_query);
	//刪除資料
	$row=mysql_fetch_row($result);
	$json_old=$row[1];
	$data=json_decode($json_old);
	for($i=0;$i<count($data->data);$i++)
	{
		if($data->data[$i]->username==$friendusername)
		{
			echo $data->data[$i]->username;
			unset($data->data[$i]);

		}
	}
	$json_new=json_encode($data,JSON_UNESCAPED_UNICODE);
	mysql_query("UPDATE friend SET friend='$json_new' where name='$username'");
?>
<script language=JavaScript>
	parent.location.reload();
</script> 