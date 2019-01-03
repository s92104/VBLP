<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");
include("loading/loading.php");

//$id = $_POST['id'];
$email = $_POST['email'];

function exist($rows)
{
    if ($rows != "") {//有人使用
        return true;
    } else {
        return false;
    }
}
function existMail($email)
{
    $chk = "SELECT * FROM member_table where email = '$email'";
    $abc = mysql_query($chk);
    $rows = mysql_num_rows($abc);
    return exist($rows);
}
//紅色字體為判斷密碼是否填寫正確
if ($_SESSION['username'] != null) {
    $id = $_SESSION['username'];
    //更新資料庫資料語法
    $sql = "SELECT * FROM member_table WHERE email = '$email'";
    $result = mysql_query($sql);
    $row = @mysql_fetch_row($result);

    $sql = "UPDATE member_table SET email='$email' WHERE username='$id'";
    if ($email != null && !existMail($email)) {//不能更改成已經有人使用的信箱
        if (mysql_query($sql)) {
            //echo '修改成功!請重新認證此信箱';
            loading('修改成功!請重新認證此信箱');
            $sql = "UPDATE member_table SET emailVerify= false WHERE username='$id'";
            mysql_query($sql);//把信箱設為沒有認證過
            echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
        } else {
            //echo "SQL錯誤!";
            loading('SQL錯誤!');
        }
    } else {
        //echo '錯誤!這個信箱已經有人使用!';
        loading('錯誤!這個信箱已經有人使用!');
        //echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
    }
} else {
    //echo '您無權限觀看此頁面!';
    loading('您無權限觀看此頁面!');
    echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
}
?>
