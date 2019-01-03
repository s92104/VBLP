<?php session_start(); header("Cache-control:nocache");?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");
include("loading/loading.php");

$id = $_SESSION['username'];
$donite = $_GET['donate'];
$title = $_GET['t'];

$sql = "SELECT * FROM member_table where username = '$id'";
$result = mysql_query($sql);
$row = @mysql_fetch_row($result);
$originpoint = $row[4];

$url = $_COOKIE['url'];
unset($_COOKIE['url']);

date_default_timezone_set("Asia/Taipei");
$time = date("Y-m-d  G:i:s");
$left = $originpoint - $donite;
$sql = "UPDATE member_table set point='$left' where username='$id'";
$sqlurl = "INSERT into record (username,title, URL, point, time) values ('$id','$title','$url', '$donite', '$time')";

$chk = "SELECT * FROM essay where URL = '$url'";
$abc = mysql_query($chk);
$exist = mysql_num_rows($abc);
//要是網址不存在資料庫裏面，就新增這個網址，並且給他點數
if ($exist != "") {
    $row = @mysql_fetch_row($abc);
    $row[1] += $donite;
    $sqlpoint = "UPDATE essay set point='$row[1]' where URL='$url'";
    mysql_query($sqlpoint);
} else {
    $sqlessay = "INSERT into essay (URL, point) values
   ('$url', '$donite')";
    mysql_query($sqlessay);
}
//紅色字體為判斷密碼是否填寫正確
if (mysql_query($sql) && mysql_query($sqlurl)) {

      //  $sql = "update member_table set password='$pw' where username='$id'";
        //if(mysql_query($sql))
        //{
                //echo '你捐獻了'.$donite.'點，您的肯定是我們前進的動力!!!';
                loading('你捐獻了'.$donite.'點，您的肯定是我們前進的動力!!!')?>

                <script language="JavaScript">
                window.setTimeout("window.close()",2500);
                </script>
                <?php
      //  }
      //  else
      //  {
        //        echo '修改失敗!';
      //          echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
      //  }
} else {
    //echo 'SQL錯誤!';
    loading('SQL錯誤');
    echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
}
?>
