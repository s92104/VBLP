<?php session_start(); ?>
<?include("sqlClass.php");
$sql = new Mysql();
$board = $_GET['board'];
$sqlstring = "SELECT * FROM $board";
$result = $sql->exe($sqlstring);
//*************
$data_nums = $sql->num_rows($result); //統計總比數
$per = 10;//每頁顯示項目數量
$pages = ceil($data_nums/$per); //取得不小於值的下一個整數
if (!isset($_GET["page"])) { //假如$_GET["page"]未設置
    $page=1; //則在此設定起始頁數
} else {
    $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
}
$start =($page-1)*$per;
$result = $sql->exe($sqlstring.' LIMIT '.$start.', '.$per);
//*************
$id = $_SESSION['username'];
$rowadmin=$sql->getRow('member_table', 'username', $id);
?>

<!DOCTYPE html>
<a href = "#" onclick="submittion('<?echo $board?>','<?echo $rowadmin[emailVerify]?>');">
  投稿&nbsp&nbsp&nbsp</a>
<?echo "這裡是".$board."版喔!<p>";?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<html lang="en">
	<head>
		<title>文章</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--===============================================================================================-->
		<link rel="icon" type="image/png" href="articlepage/images/icons/favicon.ico"/>
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="articlepage/vendor/bootstrap/css/bootstrap.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="articlepage/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="articlepage/vendor/animate/animate.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="articlepage/vendor/select2/select2.min.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="articlepage/vendor/perfect-scrollbar/perfect-scrollbar.css">
		<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="articlepage/css/util.css">
		<link rel="stylesheet" type="text/css" href="articlepage/css/member.css">
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
									時間
								</div>
								<?if ($rowadmin[token]=='1'||$rowadmin[token]==$board) {
                ?>
									<div class="cell">
										操作
									</div>
									<?php
            } ?>
							</div>
							<?php
                            $id = $_SESSION['username'];
            //將資料庫裡的所有會員資料顯示在畫面上

            $data=$sql->exe("SELECT * FROM $board ORDER BY head DESC,time DESC limit $start,$per");
            //$row = @mysql_fetch_row($result);
            $num=$per;
            if ($start+$per > $data_nums) {
                $num=$data_nums-$start;
            }

            for ($i=0;$i<$num;$i++) {
                $row=$sql->fetch_row($data); ?>
								<div class="row">
									<div class="cell" data-title="熱門">
										<?php echo $row[hot]; ?>
									</div>
									<div class="cell" data-title="標題">
										<?php echo '<a href = "article.php?title='.$row[title].'&board='.$board.'">'
                                        .$row[title].'</a>'; ?>
									</div>
									<div class="cell" data-title="作者">
										<?php echo $row[writer]; ?>
									</div>
									<div class="cell" data-title="發文時間">
										<?php echo $row[time]; ?>
									</div>
									<?php	if ($rowadmin[token]=='1'||$rowadmin[token]==$board) {
                                            echo '<div class="cell">';
                                            if ($row[head]==false) {
                                                ?>
              			<a href = "#" onclick="topping('<?echo $row[title]?>','<?echo $board?>');">置頂 </a>/
										<?php
                                            } else {
                                                ?>
											<a href = "#" onclick="untopping('<?echo $row[title]?>','<?echo $board?>');">取消置頂 </a>/
										<?php
                                            } ?>
                    <a href = "#" onclick="deleteArticle('<?echo $row[title]?>','<?echo $board?>');">刪除 </a>
                      <?php  echo '</div>';
                                        } ?>
								</div>
								<?php
            } ?>

							<!-- ***************** -->
							<!-- <H4> -->
							<div class="font_set">
								<?php
                                //分頁頁碼
                                echo '共 '.$data_nums.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
            echo "<br /><a href=?board=".$board."&&page=1>首頁</a> ";
            if ($page > 1) {
                $back_page=$page;
                echo "<a href=?board=".$board."&&page=".--$back_page.">上一頁&nbsp</a>";
            }
            echo "第 ";
            for ($i=1 ; $i<=$pages ; $i++) {
                if ($page-3 < $i && $i < $page+3) {
                    echo "<a href=?board=".$board."&&page=".$i.">".$i.'&nbsp'."</a>";
                }
            }
            if ($page < $pages) {
                $next_page=$page;
                echo "頁 <a href=?board=".$board."&&page=".++$next_page.">下一頁&nbsp</a>";
            }
            if ($page == $pages) {
                echo "頁 <a href=?board=".$board."&&page=".$pages.">末頁</a><br /><br />";
            } else {
                echo "<a href=?board=".$board."&&page=".$pages.">末頁</a><br /><br />";
            } ?>
								<!-- ***************** -->
								<!-- </H4> -->
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php
        } else {
            echo '您無權限觀看此頁面!';
            echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
        }
        ?>
<!-- controller -->
		<script type="text/javascript">
    function submittion(board,verify){
      if(verify=='1')
      {
        window.location.href = "submittion.php?board="+board;
      }
      else
      {
        alert("你的信箱還沒經過認證喔，快去會員中心認證!");
      }
    }
		function topping(title,board){
			if(confirm("確定要將\n"+title+"\n這篇文章置頂嗎?"))
			{
				window.location.href = "topping_model.php?title="+title+"&board="+board+"&top=true";
			}
		}	

		function untopping(title,board){
			if(confirm("確定要將\n"+title+"\n這篇文章取消置頂嗎?"))
			{
				window.location.href = "topping_model.php?title="+title+"&board="+board+"&top=false";
			}
		}
		function deleteArticle(title,board){
			if(confirm("確定要刪除\n"+title+"\n這篇文章嗎?"))
			{
				window.location.href = "deleteArticle_model.php?title="+title+"&board="+board;
			}
		}
		</script>
<!-- controller-->

		<!--===============================================================================================-->
		<script src="articlepage/vendor/jquery/jquery-3.2.1.min.js"></script>
		<!--===============================================================================================-->
		<script src="articlepage/vendor/bootstrap/js/popper.js"></script>
		<script src="articlepage/vendor/bootstrap/js/bootstrap.min.js"></script>
		<!--===============================================================================================-->
		<script src="articlepage/vendor/select2/select2.min.js"></script>
		<!--===============================================================================================-->
		<script src="articlepage/js/main.js"></script>

	</body>
	</html>
