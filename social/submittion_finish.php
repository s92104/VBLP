<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("sqlClass.php");
$sql = new Mysql();


$title = $_POST['title'];
$article = $_POST['article'];
$board = $_COOKIE['board'];
unset($_COOKIE['board']);
//紅色字體為判斷密碼是否填寫正確
if ($_SESSION['username'] != null) {
    $id = $_SESSION['username'];
    date_default_timezone_set("Asia/Taipei");
    $time = date("Y-m-d  G:i:s");
    //更新資料庫資料語法
    //$sql = "INSERT INTO $board(title,writer,article,time) values ('$title','$id','$article','$time')";
    if ($title!= null && $article !=null && $sql->insert($board, 'title', 'writer', 'article', 'time', $title, $id, $article, $time)) {
        echo '投稿成功!';
        echo '<script>history.go(-2)</script>';
    //echo '<meta http-equiv=REFRESH CONTENT=2;url=../>';
    } else {
        echo '投稿失敗!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=../>';
    }
} else {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=../>';
}
?>
