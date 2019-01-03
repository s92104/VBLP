<?php
	session_start();
	include("sqlClass.php");
	$sql = new Mysql();

	if ($_SESSION['username'] == null) {//如果還沒有登入就顯示登入鈕，不然就顯示登出鈕
?>	
		<meta http-equiv="refresh" content="0; url=login.php">
<?php	  
	} else {
?>	  
	<meta http-equiv="refresh" content="0; url=member/member.php">
<?php 
	}
?>	

