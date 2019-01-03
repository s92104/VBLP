<?php session_start();
include("sqlClass.php");
$sql = new Mysql();
$title = $_GET['title'];
$board = $_GET['board'];?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("member/loading/loading.php");

if ($_SESSION['username'] != null) {
    //刪除資料庫資料語法
    if ($sql->delete($board, 'title', $title)) {
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
    loading("不是管理員");
    //echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
}
?>
<script>
window.setTimeout("history.back()",1500);
</script>
