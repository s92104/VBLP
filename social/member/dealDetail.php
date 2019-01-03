<?php session_start(); ?>
<?include("../sqlClass.php");
$sql = new Mysql();
$id = $_GET['id'];
$board = $_GET['board'];
if ($board==null) {
    $board='sex';
}
echo "<a href=?board=sex&&id=".$id.">sex&nbsp&nbsp</a>";
            echo "<a href=?board=fun&&id=".$id.">fun&nbsp&nbsp</a>";
            echo "<a href=?board=gossip&&id=".$id.">gossip&nbsp&nbsp</a>";
            echo "<a href=?board=teacher&&id=".$id.">teacher&nbsp&nbsp</a>";
?>
投稿<?echo $board?>版的文章
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html lang="en">
<head>
	<title>Table V02</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="dealDetail/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dealDetail/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dealDetail/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dealDetail/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dealDetail/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dealDetail/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dealDetail/css/util.css">
	<link rel="stylesheet" type="text/css" href="dealDetail/css/member.css">
<!--===============================================================================================-->
</head>
<body>
	<?php
    if ($_SESSION['username'] != null) {
        ?>

			<div class="limiter">
				<div class="container-table100">
					<div class="wrap-table100">
				<span>
					<!--<a href = "member.php">返回首頁</a><br><br>-->
				</span>
					<div class="table">

						<div class="row header">
							<div class="cell">
							  熱門
							</div>
							<div class="cell">
								標題
							</div>
							<div class="cell">
								作者
							</div>
							<div class="cell">
								發文時間
							</div>
						</div>
						<?php

        //將資料庫裡的所有會員資料顯示在畫面上

        //  $data = mysql_query("SELECT * from record  ");

        $data = mysql_query("SELECT * FROM $board WHERE writer = '$id' order by time desc");
        //$row = @mysql_fetch_row($result);
        for ($i=1;$i<=mysql_num_rows($data);$i++) {
            $row=mysql_fetch_row($data); ?>
						<div class="row">
							<div class="cell" data-title="人氣">
							<?echo $row[hot]; ?>
							</div>
							<div class="cell" data-title="標題">
							<a href = "../article.php?title=<?php echo $row[title]; ?>&&board=<?php echo $board; ?>">
                      <?php echo $row[title]; ?></a>
							</div>
							<div class="cell" data-title="作者">
								<?php echo $row[writer]; ?>
							</div>
							<div class="cell" data-title="發文時間">
								<?php echo $row[time]; ?>
							</div>
						</div>
						<?php
        } ?>

					</div>
			</div>
		</div>
	</div>
<?php
    } else {
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=1;url=https://tw.yahoo.com/>';
    }

?>



<!--===============================================================================================-->
<script src="dealDetail/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="dealDetail/vendor/bootstrap/js/popper.js"></script>
<script src="dealDetail/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="dealDetail/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="dealDetail/js/main.js"></script>

</body>
</html>
