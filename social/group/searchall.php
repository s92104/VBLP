<?php
	include("../View.php");
	$view=initView();
	$view->setGroupView();
?>
<head>
	<meta charset="utf-8"/>
</head>
<html>
	<body>
		<?php 
			include("../mysql_connect.inc.php");
			$searchname=$_POST["name"];
			$groupname=$_POST["groupname"];
			$name_query="SELECT * FROM member_table where name like '$searchname%' OR username like '$searchname%'";
			if($searchname!=null)
			{
				$result=mysql_query($name_query);
		?>
			<div class="searchall">
				<ul>
					<?php for($i=0;$i<mysql_num_rows($result);$i++)
						{
							$row=mysql_fetch_row($result);
							$friendname=$row[5];
							$friendusername=$row[1];
					?>		
							
							<li><?php if($friendname!=null) echo $friendname; else echo $friendusername;?>
								<a href="groupinvite.php?friendusername=<?=$friendusername?>&groupname=<?=$groupname?>">+</a>
							</li>				
					<?php
						}
					?>
				</ul>
			</div>
		<?php
			}
		?>
	</body>
</html>