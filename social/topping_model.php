<?php session_start();
include("sqlClass.php");
$sql = new Mysql();
$title = $_GET['title'];
$toping = $_GET['top'];
$board = $_GET['board'];?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("member/loading/loading.php");

if ($_SESSION['username'] != null) {
    if ($toping=='true') {
        if ($sql->update($board, 'head', true, 'title', $title)) {
            //echo '刪除成功!';
            loading("置頂成功");
        //echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
        } else {
            //echo '刪除失敗!';
            loading("置頂失敗");
            //echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
        }
    } else {
        if ($sql->update($board, 'head', false, 'title', $title)) {
            //echo '刪除成功!';
            loading("取消置頂成功");
        //echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
        } else {
            //echo '刪除失敗!';
            loading("取消置頂失敗");
            //echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
        }
    }
} else {
    //echo '不是管理員/不能刪除自己';
    loading("不是管理員");
    //echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
}
?>
<script>
//window.setTimeout("history.back()",1500);
history.back();
</script>
