<?php
	include("../mysql_connect.inc.php");
	include("../View.php");
	$view=initView();
	$view->setBoardView();
	//取出使用者資料
	$all_query = "SELECT * FROM board";
	$result = mysql_query($all_query);
	define("name", 0);
?>
<!doctype html>
<html>
	<!--標頭-->
	<head>
		<meta charset="utf-8"/>		
	</head>
	<!--主體-->
	<body>
		<div class="boardlist">
			<ul>
				<li><a href = "../article_index.php?board=gossip" target="article">八卦版</a></li>
				<li><a href = "../article_index.php?board=sex" target="article">西斯版</a></li>
				<li><a href = "../article_index.php?board=teacher" target="article">教授版</a></li>
				<li><a href = "../article_index.php?board=fun" target="article">有趣版</a></li>

				<!-- <li><a href = "../article_index.php?" target="article">心情版</a></li>
				<li><a href = "../article_index.php?" target="article">寵物版</a></li>
				<li><a href = "../article_index.php?" target="article">美食版</a></li> -->

				<li><a href = "../article_index.php?" target="article">心情版</a></li>
				<li><a href = "../article_index.php?" target="article">寵物版</a></li>
				<li><a href = "../article_index.php?" target="article">美食版</a></li>

			</ul>
		</div>
	</body>
</html>
