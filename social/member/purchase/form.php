<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php session_start(); ?>
<?if($_SESSION['username'] == null)
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=0;url=../member.php>';
}?>
<form name="form" method="post" action="form_confirmation.php">
一罐油蔥酥240元，運費60元，買10罐免運<br><br><br>
收件人：<input type="text" name="name" /> <br>
電話：<input type="text" name="phone" /> <br>
數量：<input type="int" name="amount" /> <br>
收件地址：<input type="text" name="address" /> <br>
備註：<textarea name="other" cols="45" rows="5"></textarea> <br>
<input type="submit" name="button" value="確定" />
</form>