<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");

//$id = $_POST['id'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];


//紅色字體為判斷密碼是否填寫正確
if ($_SESSION['username'] != null) {
    $id = $_SESSION['username'];

    //更新資料庫資料語法
    $sql = "UPDATE member_table set password='$pw' where username='$id'";
    if (mysql_query($sql) && $pw != null && $pw2 != null && $pw == $pw2) {
        echo '修改成功!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
    } else {
        echo '修改失敗!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
    }
} else {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
}
?>
