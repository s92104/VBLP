<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
//echo phpinfo();
//$gmail = $_POST['mail'];
require("../phpMailer/class.phpmailer.php");
mb_internal_encoding('UTF-8');
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


$email="b10515007@gamil.com";
// 收件者信箱
$name="書豪";
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
$mail->Subject ="認證碼";
// 信件標題
$mail->Body = "你的驗證碼為";
//信件內容(html版，就是可以有html標籤的如粗體、斜體之類)
$mail->AltBody = "你的驗證碼為";
//信件內容(純文字版)

if (!$mail->Send()) {
    echo "寄信發生錯誤：" . $mail->ErrorInfo;
//如果有錯誤會印出原因
} else {
    echo "寄信成功";
}
