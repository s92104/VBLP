<?php
	include("social/View.php");
	$view=initView();
	$view->setIndexView();
?>
<html>
	<!--標頭-->
	<head>
		<meta charset="utf-8"/>
		<title>台科大交友</title>
	</head>
	<!--主體-->
	<body>
		<div class="page">
			<!--選單-->
			<div class="menu">
				<a href="social/index.php" target="content">
					<img src="social/img/diamond.svg" align="center" width="50" height="60">會員
				</a>
				<a href="social/board.php" target="content">
					<img src="social/img/text.svg" align="center" width="50" height="60">看板
				</a>
				<a href="social/group.php" target="content">
					<img src="social/img/coffe_tea.svg" align="center" width="50" height="60">群組
				</a>
				<a href="social/friend.php" target="content">
					<img src="social/img/team.svg" align="center" width="50" height="60">朋友
				</a>	
				<a href="social/pickcard/pickcard.php" target="content">
					<img src="social/img/card.svg" align="center" width="50" height="60">抽卡
				</a>	
				<a href="social/logout.php" target="content">
					<img src="social/img/power.svg" align="center" width="50" height="60">登出
				</a>
			</div>
			<!--內容-->
			<div class="content">
				<iframe name="content" src="social/index.php" width="100%" height="100%" frameborder="0" scrolling="auto" allowfullscreen></iframe>
			</div>
		</div>
		
	</body>

</html>
