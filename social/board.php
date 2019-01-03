<?php 
	include("View.php");
	$view=initView();
	$view->setBoardView();
?>
<html>
	<!--標頭-->
	<head>
		<meta charset="utf-8"/>		
	</head>
	<!--主體-->
	<body>
		<div class="sidebar">
			<!--看板選單-->
			<div class="type">					
				<a href="board/hotboard.php" target="board" style="color:red;font-weight:bold;">
					<img src="board/img/crown.svg" width="50" height ="50" align="center">熱門看板
				</a>
				<a href="board/allboard.php" target="board">
					<img src="board/img/list_item.svg" width="50" height ="50" align="center">全部看板
				</a>					
			</div>
			<!--看板列表-->
			<div class="board">
				<iframe name="board" src="board/hotboard.php" width="100%" height="100%" frameborder="0" scrolling="auto" allowfullscreen></iframe>
			</div>
			<!--新增看板-->
			<div class="addboard">
				<a href>
					新增看板
				</a>
			</div>
		</div>
		<div class="article">
			<iframe name="article" src="article_index.php?board=gossip" width="100%" height="100%" frameborder="0" scrolling="auto" allowfullscreen></iframe>
		</div>
	</body>
</html>