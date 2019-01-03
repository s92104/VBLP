<?php
	include("../mysql_connect.inc.php");
	include("../View.php");
	$view=initView();
	$view->setBoardView();
?>
<html>
<!--標頭-->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<!--主體-->
<body>
	<div class="boardlist">
		<ul>
			<li><a href = "../article_index.php?board=gossip" target="article">八卦版</a></li>
			<li><a href = "../article_index.php?board=sex" target="article">西斯版</a></li>
			<li><a href = "../article_index.php?board=teacher" target="article">教授版</a></li>
			<li><a href = "../article_index.php?board=fun" target="article">有趣版</a></li>
			<form action="ad.php" method="post" enctype="multipart/form-data">
				上傳圖檔廣告:<input type="file" name="fileField" id="file">
			<input type="submit" name="submit" value="上傳" /><p>
			</form>
			<?$file = scandir('ads');
            for ($i=2;$i<=count($file)-1;$i++) {
                $file[$i]=iconv("BIG-5", "UTF-8", $file[$i]);
                //echo $file[$i].'<br>';
                if ($file[$i]!="desktop.ini") {
                    ?>

			<img src="ads/<?echo $file[$i]?>" align="center" width="250" height="300">

		<?php
                }
            }?>
		</ul>

	</div>
</body>
</html>
