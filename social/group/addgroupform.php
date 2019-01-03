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
			<form method="post" action="addgroup.php">
				<div class="title">
				新增群組
				</div>
				<div class="texttitle">
					群組名稱
				</div>
				<input class="text" type="text"name="name"/><br>
				<div class="texttitle">
					群組簡介
				</div>
				<input class="text" type="text" name="intro"/><br>
				<input class="btn" type="submit" value="新增"/>
			</form>
		</div>
	</body>
</html>
