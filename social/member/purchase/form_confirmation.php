<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
訂單最後確定<br><br>

<table border="1" width = 40%>
　<tr>
　<td>收件人</td>
　<td>收件人電話</td>
<td>數量</td>
<td>價錢</td>
<td>送件地址</td>
<td>備註</td>
　</tr>
<?php
if($_SESSION['username'] == null)
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=0;url=../member.php>';
}

$id = $_POST['name'];
$telephone = $_POST['phone'];
$amount = $_POST['amount'];
$address = $_POST['address'];
$other = $_POST['other'];
//判斷帳號密碼是否為空值
//確認密碼輸入的正確性
if($id == null || $telephone == null || $amount == null || $address == null)
{
  echo '您表單沒有填寫完整!幫你回上一頁';
  echo '<meta http-equiv=REFRESH CONTENT=2;url=form.php>';
}

?>
　<tr>
  <td><? echo $id;   ?></td>
  <td><? echo $telephone;   ?></td>
  <td><? echo $amount;   ?></td>
  <td><? echo $amount*240;   ?></td>
  <td><? echo $address;   ?></td>
  <td><? echo $other;   ?></td>
　</tr>
</table>
<form name="form" method="post" action="form_finish.php">
一罐油蔥酥240元，運費60元，買10罐免運<br><br><br>
收件人：<input type="text" name="name" value=<?echo $id?>> <br>
電話：<input type="text" name="phone" value=<?echo $telephone?>> <br>
數量：<input type="int" name="amount" value=<?echo $amount?>> <br>
收件地址：<input type="text" name="address" value=<?echo $address?>> <br>
備註：<textarea name="other" cols="45" rows="5" ><?echo $other?></textarea> <br>
<input type="submit" name="button" value="送出訂單" />
</form>
