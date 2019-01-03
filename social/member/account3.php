	<?php session_start(); ?>
	<?include("mysql_connect.inc.php");
    define("token", 0);
    define("username", 1);
    define("email", 3);
    define("point", 4);
    define("name", 5);
    define("genre", 6);
    define("emailVerify", 7);
    define("verifyCode", 8);
    $sql = "SELECT * FROM member_table";
    $result = mysql_query($sql);
        //*************
    $data_nums = mysql_num_rows($result); //統計總比數
    $per = 10;//每頁顯示項目數量
    $pages = ceil($data_nums/$per); //取得不小於值的下一個整數
    if (!isset($_GET["page"])) { //假如$_GET["page"]未設置
        $page=1; //則在此設定起始頁數
    } else {
        $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
    }
    $start =($page-1)*$per;
    $result = mysql_query($sql.' LIMIT '.$start.', '.$per) or die("Error");
        //*************
    $id = $_SESSION['username'];
    $sql = "SELECT * FROM member_table";
    $result = mysql_query($sql);
    $rowadmin = @mysql_fetch_row($result);
    if ($rowadmin[token]!='1') {//排除非管理員的帳號近來此頁面
    ?>
		<script>
		history.back();
		</script><?php
    }
    ?>
	<!DOCTYPE html>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<html lang="en">
	<head>
		<title>管理</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
		<link rel="icon" type="image/png" href="memberManage/images/icons/favicon.ico"/>
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="memberManage/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="memberManage/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="memberManage/vendor/animate/animate.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="memberManage/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="memberManage/vendor/perfect-scrollbar/perfect-scrollbar.css">
	<!--===============================================================================================-->
		<link rel="stylesheet" type="text/css" href="memberManage/css/util.css">
		<link rel="stylesheet" type="text/css" href="memberManage/css/member.css">
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
									使用者
								</div>
								<div class="cell">
									電子郵件
								</div>
								<div class="cell">
									剩餘點數
								</div>
								<div class="cell">
									帳戶類型
								</div>
								<div class="cell">
									操作
								</div>
							</div>
							<?php
                            $id = $_SESSION['username'];
        //將資料庫裡的所有會員資料顯示在畫面上

        $data=mysql_query("SELECT * from member_table order by token desc limit $start,$per");
        //$row = @mysql_fetch_row($result);
        $num=$per;
        if ($start+$per > $data_nums) {
            $num=$data_nums-$start;
        }

        for ($i=0;$i<$num;$i++) {
            $row=mysql_fetch_row($data); ?>
							<div class="row">
								<div class="cell" data-title="Username">
									<?php echo $row[username];
            if ($row[token]=='1') {
                echo "(admin)";
            } elseif ($row[token]!='0') {
                echo '('.$row[token].')';
            } ?>
								</div>
								<div class="cell" data-title="Email">
										<?php echo $row[email]; ?>
								</div>
								<div class="cell" data-title="Left Points">
										<?php echo $row[point]; ?>
								</div>
								<div class="cell" data-title="genre">
										<?php echo $row[genre]; ?>
								</div>
								<div class="cell">
									<a href = "#" onclick="addPoint('<?echo $row[username]; ?>');">分配點數 </a>/
									<?if ($row[token] != '1') {
                echo'<a href = "dealDetail.php?id='.$row[username].'">查看 </a>/'; ?>
                      <a href = "#" onclick="deleteMember('<?echo $row[username]; ?>');">刪除帳號</a>
                  <?php
            } else {
                echo'<a href = "#" onclick="allAddPoint();">分發 </a>/';

                echo '管理員帳號';
            } ?>
								</div>
							</div>
							<?php
        } ?>

								<!-- ***************** -->
								<!-- <H4> -->
								<div class="font_set">
								<?php
                //分頁頁碼
                echo '共 '.$data_nums.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
        echo "<br /><a href=?page=1>首頁</a> ";
        if ($page > 1) {
            $back_page=$page;
            echo "<a href=?page=".--$back_page.">上一頁&nbsp</a>";
        }
        echo "第 ";
        for ($i=1 ; $i<=$pages ; $i++) {
            if ($page-3 < $i && $i < $page+3) {
                echo "<a href=?page=".$i.">".$i.'&nbsp'."</a>";
            }
        }
        if ($page < $pages) {
            $next_page=$page;
            echo "頁 <a href=?page=".++$next_page.">下一頁&nbsp</a>";
        }
        if ($page == $pages) {
            echo "頁 <a href=?page=".$pages.">末頁</a><br /><br />";
        } else {
            echo "<a href=?page=".$pages.">末頁</a><br /><br />";
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
        echo '<meta http-equiv=REFRESH CONTENT=1;url=../index.php>';
    }
    ?>
	<script type="text/javascript">
	function allAddPoint(){
		var point = prompt("請問要分配幾點給所有使用者?");
	 if(point != null)
	 {
			 window.location.href = "addpoint.php?all="+"all"+"&point="+point;
	 }
	}
	function deleteMember(name){
		 if(confirm("確定要刪除"+name+"這個帳號嗎?"))
		 {
				window.location.href = "delete_finish.php?name=" + name;
			}
	}
	function addPoint(name){
		var point = prompt("請問要分配幾點給使用者"+name+"?");
		if(point != null)
		{
				window.location.href = "addpoint.php?name="+name+"&point="+point;
		}
	}
	</script>


	<!--===============================================================================================-->
	<script src="memberManage/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="memberManage/vendor/bootstrap/js/popper.js"></script>
	<script src="memberManage/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="memberManage/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="memberManage/js/main.js"></script>

	</body>
	</html>
