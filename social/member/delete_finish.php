<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");
include("loading/loading.php");
$admin = $_SESSION['username'];
$id = $_GET['name'];
$sql = "SELECT * FROM member_table where username = '$admin'";
$result = mysql_query($sql);
$row = @mysql_fetch_row($result);
if ($_SESSION['username'] != null && $row[0] == 1) {
    //刪除資料庫資料語法
    $sql = "delete from member_table where username='$id'";
    // $sql2 = "delete from record where username = '$id'";
    if (mysql_query($sql)) {
        //echo '刪除成功!';
        loading("刪除成功");
    //echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
    } else {
        //echo '刪除失敗!';
        loading("刪除失敗");
        //echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
    }
} else {
    //echo '不是管理員/不能刪除自己';
    loading("不是管理員/不能刪除自己");
    //echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
}
?>
<script>
window.setTimeout("history.back()",1500);
</script>
