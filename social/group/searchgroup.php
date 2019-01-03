<?php
	include("../View.php");
	$view=initView();
	$view->setGroupView();
?>
<head>
	<meta charset="utf-8"/>
	<script language=JavaScript>
		function delete_group(groupname)
		{
			if(confirm("確定退出群組?"))
				document.location.href="deletegroup.php?groupname="+groupname;
		}
	</script>
</head>
<html>
	<body style="margin:0">
		<?php 
			include("../mysql_connect.inc.php");
			$searchname=$_POST["name"];
			$username=$_GET["username"];
			$name_query="SELECT * FROM group_table where name = '$username'";
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
				}										
			}
			
			for($i=0;$i<count($data_query);$i++)
			{	
				$groupname=$data_query[$i]->name;
		?>
				<div class="groupblock">
					<div class="groupname">
						<a href="../group.php?groupname=<?=$groupname?>" target="content">
							<?php echo $data_query[$i]->name."<br>".$data_query[$i]->intro?>
						</a>
					</div>
					<div class="deletegroup">
						<a href="javascript:delete_group('<?=$data_query[$i]->name?>')" >
							X
						</a>
					</div>			
				</div>
		<?php		
			}
		?>

	</body>
</html>