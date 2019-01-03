<?php
	//接收資料
	session_start();
	$username=$_SESSION['username'];;
	$groupname=$_GET["groupname"];
	include("../mysql_connect.inc.php");
	//找自己資料
	$group_query="SELECT * FROM group_table where name = '$username'";
	$result=mysql_query($group_query);
	//刪除資料
	$row=mysql_fetch_row($result);
	$json_old=$row[1];
	$data=json_decode($json_old);
	for($i=0;$i<count($data->data);$i++)
	{
		if($data->data[$i]->name==$groupname)
			unset($data->data[$i]);
	}
	$json_new=json_encode($data,JSON_UNESCAPED_UNICODE);
	mysql_query("UPDATE group_table SET groups='$json_new' where name='$username'");
?>
<script language=JavaScript>
	parent.location.reload();
</script> 