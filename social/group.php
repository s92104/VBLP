<?php
session_start();
$username=$_SESSION['username'];
$groupname=$_GET['groupname'];

define("name", 0);
?>
<?php
	include("View.php");
	$view=initView();
	$view->setGroupView();
?>
<html>
	<!--標頭-->
	<head>
		<meta charset="utf-8"/>
		<script src="jquery-2.1.1.min.js"></script>
		<script>
	$(document).ready(function() {
	   $("form#chatform").submit(function (e) { // Ajax送出表單
		  e.preventDefault();
		  var message = $("#message").val(); // 取得訊息
		  var filename= '<?php echo $groupname.".html" ?>';
		  // 使用HTTP POST方法送出Ajax請求至PHP程式
		  $.post("group/chat.php", {text: message,filename:filename});
		  $("#message").val('');
		  return false;
	   });
	   function loadContent() {  // 載入聊天訊息
		  var oldHeight = $("#chatroom").prop("scrollHeight") - 20;
		  var filename= '<?php echo $groupname.".html" ?>';
		  if(filename!="")
		  {
		  // 送出Ajax請求messages.html網頁
		  $.ajax({
			 url: "group/message/"+filename,
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
	<!--主體-->
	<body>
		<!--群組-->
		<div class="grouplist">
			<!--群組表單-->
			<div class="groupform">
				<form method="post" action="group/searchgroup.php?username=<?=$username?>" target="grouplist">
					<input class="searchtxt" type="text" placeholder="搜尋群組" name="name"/>
					<input class="searchbtn" type="submit" value="搜尋"/>
				</form>
			</div>
			<!--重整-->
			<div class="grouprefresh">
				<a href="group/searchgroup.php?username=<?=$username?>" target="grouplist"><img src="group/img/refresh.svg" width="50" height="50"></a>
			</div>
			<!--新增-->
			<div class="addgroup">
				<a href="group/addgroupform.php" target="content"><img src="group/img/plus.svg" width="50" height="50"></a>
			</div>
			<!--群組列表-->
			<iframe name="grouplist" src="group/searchgroup.php?username=<?=$username?>" width="100%" height="100%" frameborder="0" scrolling="auto" allowfullscreen></iframe>
		</div>
		<!--聊天-->
		<div class="chat">
			<!--聊天室-->
			<div class="chatcontent" id="chatroom">

			</div>
			<!--聊天表單-->
			<div class="chatform">
				<form id="chatform" method="post" action="#">
					<input type="text" size="110" id="message"/>
					<input type="submit" value="傳送"/>
				</form>
			</div>
		</div>
		<!--線上-->
		<div class="online">
			<!--搜尋線上-->
			<div class="groupform">
				<form method="post" action="group/searchonline.php?groupname=".<?=$groupname?> target="searchlist">
					<input class="searchtxt" type="text" placeholder="搜尋線上" name="name"/>
					<input class="searchbtn" type="submit" value="搜尋"/>
				</form>
			</div>
			<div class="onlinerefresh">
				<a href="group/searchonline.php?groupname=<?=$groupname?>" target="searchlist"><img src="group/img/refresh.svg" width="50" height="50"></a>
			</div>
			<div class="groupinvite">
				<a href="group/groupinviteform.php?" target="content"><img src="group/img/mail.svg" width="50" height="50"></a>
			</div>
			<!--搜尋結果-->
			<div class="searchlist">
				<iframe name="searchlist"  src="<?php if ($groupname!=null) {
    echo "group/searchonline.php?groupname=".$groupname;
} ?>" width="100%" height="100%" frameborder="0" scrolling="auto" allowfullscreen></iframe>
			</div>
		</div>
	</body>
</html>
