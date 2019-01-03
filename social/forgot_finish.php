<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");
include("member/loading/loading.php");
require("member/phpMailer/class.phpmailer.php");

mb_internal_encoding('UTF-8');



//紅色字體為判斷密碼是否填寫正確

$getmail = $_POST['email'];

$sql = "SELECT * FROM member_table WHERE email = '$getmail'";
$result = mysql_query($sql);
$row = @mysql_fetch_row($result);

if ($row != "" && $row[6] == 'Local') {
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true; // turn on SMTP authentication
    $mail->CharSet = "UTF-8";
    // $mail->SMTPOptions = array(
//     'ssl' => array(
//         'verify_peer' => false,
//         'verify_peer_name' => false,
//         'allow_self_signed' => true
//     )
    // );
    //這幾行是必須的
    $mail->Username = "pointSystemNTUST";
    $mail->Password = "B10515007B10530301";
    //這邊是你的gmail帳號和密碼

    $mail->FromName = "點數系統";
    // 寄件者名稱(你自己要顯示的名稱)
    $webmaster_email = "noreply";
    //回覆信件至此信箱


    $email = $getmail;

    // 收件者信箱
    $name = "忘記";
    // 收件者的名稱or暱稱
    $mail->From = $webmaster_email;


    $mail->AddAddress($email, $name);
    $mail->AddReplyTo($webmaster_email, "Squall.f");
    //這不用改

    $mail->WordWrap = 50;
    //每50行斷一次行

    //$mail->AddAttachment("/XXX.rar");
    // 附加檔案可以用這種語法(記得把上一行的//去掉)

    $mail->IsHTML(true); // send as HTML


    //$mail->Subject = iconv("big5", "UTF-8", "信件標題");
    $mail->Subject ="忘記帳號密碼";
    // 信件標題
    $mail->Body = '您的帳號為 : '.$row[1].'<br>密碼為 : '.$row[2].'<br>'.
    "看完此信後，請立刻刪除，保護您的帳號";
    //信件內容(html版，就是可以有html標籤的如粗體、斜體之類)
    $mail->AltBody = '您的帳號為 : '.$row[1].'<br>密碼為 : '.$row[2].'<br>'.
    "看完此信後，請立刻刪除，保護您的帳號";
    //信件內容(純文字版)

    if (!$mail->Send()) {
        ?>
  <script>
   //history.back();
  </script>
  <?php
  echo "寄信發生錯誤：" . $mail->ErrorInfo;
    //如果有錯誤會印出原因
    } else {
        //echo "帳號密碼已寄出，請去查看";
        loading("帳號密碼已寄出，請去查看");
        //echo "寄信成功";
    }
} else {
    //echo "查無此信箱，請重新輸入";
    loading("查無此信箱，請重新輸入"); ?>
<script>
window.setTimeout("history.back()",1000);
</script>
<?php
}?>
