<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");
include("loading/loading.php");

$code = $_POST['code'];


//紅色字體為判斷密碼是否填寫正確
if ($_SESSION['username'] != null) {
    $id = $_SESSION['username'];
    //更新資料庫資料語法
    $sql = "SELECT * FROM member_table WHERE username = '$id'";
    $result = mysql_query($sql);
    $row = @mysql_fetch_row($result);

    $sql = "UPDATE member_table SET emailVerify= true WHERE username='$id'";
    if ($code != null && $code == $row[8]) {//$row[8]是驗證碼
        if (mysql_query($sql)) {
            //echo '信箱已認證成功!';
            loading('信箱已認證成功!');
            echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
        } else {
            //echo "SQL錯誤!";
            loading('SQL錯誤!');
        }
    } else {
        //echo '錯誤!認證失敗，重新輸入!';
        loading('錯誤!認證失敗，重新輸入!');
        echo '<meta http-equiv=REFRESH CONTENT=2;url=waitCode.php>';
    }
} else {
    //echo '您無權限觀看此頁面!';
    loading('您無權限觀看此頁面!');
    echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
}
?>
