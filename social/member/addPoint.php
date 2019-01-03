<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");
$all = $_GET['all'];
$id = $_GET['name'];
$point = $_GET['point'];
$sql = "SELECT * FROM member_table where username = '$id'";
$result = mysql_query($sql);
$row = @mysql_fetch_row($result);
if ($id != null && $point != null) {
    $point += $row[4];
    $sql = "UPDATE member_table set point = '$point' where username = '$id'";
    if (mysql_query($sql)) {
        echo '增加成功!';
    //echo '<meta http-equiv=REFRESH CONTENT=1;url=memberManage.php>';
    } else {
        echo 'SQL失敗';
        //echo '<meta http-equiv=REFRESH CONTENT=1;url=memberManage.php>';
    }
} elseif ($all == 'all') {
    echo '正在分配給所有使用者'.$point.'點';
    $data=mysql_query("SELECT * from member_table");
    $seperatepoint = $point;
    for ($i=1;$i<=mysql_num_rows($data);$i++) {
        $row=mysql_fetch_row($data);
        $point += $row[4];
        $sql = "UPDATE member_table set point = '$point' where username = '$row[1]'";
        mysql_query($sql);
        $point = $seperatepoint;
    }
} else {
    echo '您無權限觀看此頁面!';
    //echo '<meta http-equiv=REFRESH CONTENT=1;url=memberManage.php>';
}
?>
<script>
window.setTimeout("history.back()",1000);
</script>
