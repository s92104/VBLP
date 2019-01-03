<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
投稿文章<br><br>
<?php
$board = $_GET['board'];
if ($_SESSION['username'] != null) {
    //將$_SESSION['username']丟給$id
    //這樣在下SQL語法時才可以給搜尋的值
    setcookie('board', $board, time()+3600, '/');
    //若以下$id直接用$_SESSION['username']將無法使用
    echo "<form name=\"form\" method=\"post\" action=\"submittion_finish.php\">";
    echo "標題<br><textarea name=\"title\" cols=\"45\" rows=\"3\"
    placeholder=\"[中括弧輸入文章種類]後面是標題\"></textarea> <br>";
    echo "內文：<br><textarea name=\"article\" cols=\"45\" rows=\"15\"></textarea> <br>";
    echo "<input type=\"submit\" name=\"button\" value=\"確定\" />";
    echo "</form>";
} else {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=../>';
}
?>
