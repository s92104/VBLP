<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");

$id = $_POST['name'];
$telephone = $_POST['phone'];
$amount = $_POST['amount'];
$address = $_POST['address'];
$other = $_POST['other'];
$price = $amount*240;
//判斷帳號密碼是否為空值
//確認密碼輸入的正確性

if($id != null && $telephone != null && $amount != null && $address != null)
{
        //新增資料進資料庫語法
        $sql = "insert into order_list (recipients, phone, amount,price, address, other) values ('$id', '$telephone', '$amount', '$price','$address', '$other')";
        if(mysql_query($sql))
        {
                echo '下單成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=../member.php>';
        }
        else
        {
                echo '下單失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=../member.php>';
        }
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
?>
