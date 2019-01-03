<?php session_start(); ?>
<?include("../sqlClass.php");
$id = $_SESSION['username'];
$sql = new Mysql();
$rows = $sql->getRow('pickcard', 'name', $id);
function exist($rows)
{
    if ($rows != "") {//有人使用
        return 'true';
    } else {
        return 'false';
    }
}
?>
<?php
	include("../View.php");
	$view=initView();
	$view->setPickcardView();
?>
<html>
	<head>
		<meta charset="utf-8"/>
	</head>
	<body>
		<div class="page">	
			<div class="background">
				<div class="time bottom">
					<span>
						<div id="y"></div>
						Years
					</span>
					<span>
						<div id="mo"></div>
						Months
					</span>
					<span>
						<div id="d"></div>
						Days
					</span>
				</div>
				<div class="time top">
					<span>
						<div id="h"></div>
						Hours
					</span>
					<span>
						:
					</span>
					<span>
						<div id="m"></div>
						Minutes
					</span>
					<span>
						<div id="s"></div>
						Seconds
					</span>
				</div>				
			</div>
		</div>
		<?$writen=exist($rows)?>
		<div class="form" align="center">
			<div class="write">
				<a href = "writeCard.php">寫卡片</a>
			</div>
			<div class="read">
				<a href = "#" onclick="pickcard('<?echo $writen?>')">抽卡片</a>
			</div>
		</div>
		
		
		<!--controller  -->
		<script>
		function pickcard(w){
			if(w=='false'){
				alert("你還沒有寫卡片喔!!");
			}
			else{
				window.location.href = "seeCard.php?";
			}
		}
		</script>
		<script src="time.js"></script>
	</body>
</html>
