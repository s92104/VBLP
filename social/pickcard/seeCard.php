<!DOCTYPE html>
<?php session_start();
include("../mysql_connect.inc.php");
//取出使用者資料
$id = $_SESSION['username'];
do {
    $randomsql = "SELECT * FROM pickcard WHERE 1 order by rand() limit 1";
    $randomresult = mysql_query($randomsql);
    $randomrow = mysql_fetch_row($randomresult);
} while ($randomrow[0] == $id);
$card = json_decode($randomrow[1]);
?>
<?php if ($_SESSION['username']== null) {
    echo "<script>history.back();</script>";//排除路人
}?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>User</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 放CSS -->
  <link rel="stylesheet" type="text/css" href="member/css/user.css">
  <link rel="stylesheet" type="text/css" href="member/css/boot.css">
  <link rel="stylesheet" type="text/css" href="css/pickcard.css">
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

</head>



<body class="body2">
	<div class="card">
		<div class="front">
			<img src="img/backcard.jpg">
		</div>
		<div class="back">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">抽卡囉</h3>
				</div>

				<div class="panel-body">
					<div class="row">
						<!-- 放使用者照片的 -->
						<div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="./user.png" class="img-circle img-responsive"> </div>

						<div class="col-md-9 col-lg-9">
							<table class="table table-user-information">
								<tbody>
									<tr>
									  <td style="font-weight:bold;">卡友ID</td>
									  <td><?echo $card->id?></td>
									</tr>
									<tr>
									  <td style="font-weight:bold;">名子</td>
									  <td><?echo $card->name?></td>
									</tr>
									<td style="font-weight:bold;">性別</td>
									<td><?echo $card->gender?></td>
									<tr>
										<td style="font-weight:bold;">學校</td>
										<td><?echo $card->school?></td>
									</tr>
									<tr>
										<td style="font-weight:bold;">系級</td>
										<td><?echo $card->major?></td>
									</tr>
									<tr>
										<td style="font-weight:bold;">興趣</td>
										<td><?echo nl2br($card->interest)?></td>
									</tr>
									<tr>
										<td style="font-weight:bold;">他想說的笑話</td>
										<td><?echo nl2br($card->fun)?></td>
									</tr>
								</tbody>
							</table>
							<a href="#" onclick="if(prompt('請問這個卡友哪裡有問題')){alert('已回報，謝謝你的檢舉')};"class="btn btn-primary">檢舉</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
             
</body>
</html>
