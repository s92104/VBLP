<?php
	include("../View.php");
	$view=initView();
	$view->setGroupView();
?>
<html>
	<head>
		<meta charset="utf-8"/>	
	</head>
	<body>
		<div class="form" align="center">
			<form method="post" action="searchall.php" target="searchlist">
				<div class="title">
					邀請好友
				</div>
				<div class="texttitle">
					好友名字
				</div>
				<input class="text" type="text"placeholder="名字" name="name"/><br>
				<div class="texttitle">
					群組名稱
				</div>
				<input class="text" type="text"placeholder="群組名稱" name="groupname"/><br>
				<input class="btn" type="submit" value="搜尋"/>
			</form>
			<iframe class="searchlist" name="searchlist" width="100%" height="100%" frameborder="0" scrolling="auto" allowfullscreen></iframe>
		</div>
	</body>
</html>
