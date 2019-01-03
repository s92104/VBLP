<?php
session_start();
$username=$_SESSION['username'];
$filename=$_GET['filename'];
include("mysql_connect.inc.php");
//取出使用者資料
$name_query = "SELECT * FROM friend where name='$username'";
$result = mysql_query($name_query);
define("name", 0);
define("friend", 1);
?>
<?php
	include("View.php");
	$view=initView();
	$view->setFriendView();
?>

<head>
	<meta charset="utf-8"/>
	<script src="jquery-2.1.1.min.js"></script>
	<script>
	$(document).ready(function() {
	   $("form#chatform").submit(function (e) { // Ajax送出表單
		  e.preventDefault();
		  var message = $("#message").val(); // 取得訊息
		  var filename= '<?php echo $filename ?>';
		  // 使用HTTP POST方法送出Ajax請求至PHP程式
		  $.post("friend/chat.php", {text: message,filename:filename});
		  $("#message").val('');
		  return false;
	   });
	   function loadContent() {  // 載入聊天訊息
		  var oldHeight = $("#chatroom").prop("scrollHeight") - 20;
		  var filename= '<?php echo $filename ?>';
		  if(filename!="")
		  {
		  // 送出Ajax請求messages.html網頁
		  $.ajax({
			 url: "friend/message/"+filename,
			 cache: false,
			 success: function(content) {
				// 插入聊天訊息至#chatwindow
				$("#chatroom").html(content);
				var newHeight = $("#chatroom").prop("scrollHeight") - 20;
				if ( newHeight > oldHeight ) {
				   // 自動捲動div元素
				   $("#chatroom").animate({ scrollTop: newHeight }, 'slow');
				}
			 }
			});
		  }

	   }
	   setInterval(loadContent, 1000);  // 定時更新內容
	});
	</script>
</head>
<html>
	<body>
		<!--好友-->
		<div class="friendlist">
			<!--搜尋好友表單-->
			<div class="friendform">
				<form method="post" action="friend/searchfriend.php?username=<?=$username?>" target="friendlist">
					<input class="searchtxt" type="text" name="name" placeholder="搜尋好友"/>
					<input type="submit" value="搜尋" class="searchbtn" />
				</form>
			</div>
			<!--重整-->
			<div class="friendrefresh">
				<a href="friend/searchfriend.php?username=<?=$username?>" target="friendlist"><img src="friend/img/refresh.svg" width="50" height="50"></a>
			</div>
			<!--好友列表-->
			<iframe name="friendlist" src="friend/searchfriend.php?username=<?=$username?>" width="100%" height="100%" frameborder="0" scrolling="auto" allowfullscreen></iframe>
		</div>
		<!--聊天-->
		<div class="chat">
			<!--聊天室-->
			<div class="chatcontent" id="chatroom"></div>
			<!--聊天表單-->
			<div class="chatform">
				<form id="chatform" method="post" action="#">
					<input class="chattxt" type="text" placeholder="輸入訊息....." id="message"/>
					<input class="chatbtn" type="submit" value="傳送"/>
				</form>
			</div>
		</div>
		<!--搜尋-->
		<div class="search">
			<!--搜尋表單-->
			<div class="searchform">
				<form method="post" action="friend/searchall.php" target="searchlist">
					<input class="searchtxt" type="text" placeholder="搜尋全部" name="name"/>
					<input class="searchbtn" type="submit" value="搜尋"/>
				</form>
			</div>
			<!--搜尋結果-->
			<div class="searchlist">
				<iframe name="searchlist" width="100%" height="100%" frameborder="0" scrolling="auto" allowfullscreen></iframe>
			</div>
		</div>
	</body>
</html>
