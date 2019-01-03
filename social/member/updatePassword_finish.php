<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");
include("loading/loading.php");

//$id = $_POST['id'];
$oldpw = $_POST['oldpw'];
$newpw = $_POST['newpw'];
$newpw2 = $_POST['newpw2'];


//紅色字體為判斷密碼是否填寫正確
if ($_SESSION['username'] != null) {
    $id = $_SESSION['username'];
    //更新資料庫資料語法
    $sql = "SELECT * FROM member_table where username = '$id'";
    $result = mysql_query($sql);
    $row = @mysql_fetch_row($result);

    $sql = "UPDATE member_table set password='$newpw' where username='$id'";
    if ($oldpw != null && $newpw != null && $newpw2 != null && $newpw == $newpw2 && $oldpw == $row[2]) {//$row[2]是舊密碼
        if (mysql_query($sql)) {
            //echo '修改成功!';
            loading('修改成功!');
            echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
        } else {
            echo "SQL錯誤!";
        }
    } else {
        //echo '錯誤!新密碼不一致，舊密碼有誤或輸入空值!';
        loading('錯誤!新密碼不一致，舊密碼有誤或輸入空值!');
        //echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
    }
} else {
    //echo '您無權限觀看此頁面!';
    loading('您無權限觀看此頁面!');
    echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
}
?>
