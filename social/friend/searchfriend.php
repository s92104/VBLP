<?php
	include("../View.php");
	$view=initView();
	$view->setFriendView();
?>
<head>
	<meta charset="utf-8"/>
	<script src="friend.js"></script>
</head>
<html>
	<body style="margin:0">
		<?php 
			include("../mysql_connect.inc.php");
			$searchname=$_POST["name"];
			$username=$_GET["username"];
			$name_query="SELECT * FROM friend where name = '$username'";
			$result=mysql_query($name_query);			
			$row=mysql_fetch_row($result);
			$json=$row[1];
			$data=json_decode($json);
			//判斷是否搜尋
			$data_query=array();
			//列出全部
			if($searchname==null)
				$data_query=$data->data;
			//搜尋好友
			else
			{
				for($i=0;$i<count($data->data);$i++)
				{
					if(preg_match("/$searchname/i", $data->data[$i]->name))
						array_push($data_query,$data->data[$i]);	
					else if(preg_match("/$searchname/i", $data->data[$i]->username))
						array_push($data_query,$data->data[$i]);	
				}										
			}
			
			for($i=0;$i<count($data_query);$i++)
			{	
		?>
				<div class="friendblock">
					<div class="friendname">
						<a href="../friend.php?filename=<?=$data_query[$i]->filename?>" target="content">
							<?php if($data_query[$i]->name!=null)echo $data_query[$i]->name; else echo $data_query[$i]->username;?>
						</a>
					</div>
					<div class="deletefriend">
						<a href="javascript:delete_confirm('<?=$data_query[$i]->username?>')" >
							X
						</a>
					</div>
				</div>
		<?php		
			}
		?>

	</body>
</html>