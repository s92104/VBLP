<?php
session_start();
include("../sqlClass.php");
$sql = new Mysql();
$id = $_SESSION['username'];
$row = $sql->getRow('member_table', 'username', $id);
if ($row[point]-30 >= 0) {
    $notenought=0;
} else {
    $notenought=1;
    echo '<script>';
    echo 'alert("你的點數不夠30點喔!!")';
    echo '</script>';
}
$type=$_FILES['fileField']['type'];
$size=$_FILES['fileField']['size'];
$name=iconv("UTF-8", "BIG-5", $_FILES['fileField']['name']);
$nameEcho=$_FILES['fileField']['name'];
$tmp_name=$_FILES['fileField']['tmp_name'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上傳結果</title>
</head>

<body>
<?php

if ($notenought==0) {
    $sizemb=round($size/1024000, 2);
    echo "檔案類型：".$type."</br>";
    echo "檔案大小：".$sizemb."MB</br>";
    echo "檔案名稱：".$nameEcho."</br>";
    echo "暫存名稱：".$tmp_name."</br>";
    date_default_timezone_set("Asia/Taipei");
    if ($type=="image/jpeg" || $type=="image/png" || $type=="image/gif") {
        if ($sizemb < 3) {
            $file=explode(".", $name);
            //$new_name="ad";
            $new_name=$file[0]."-".date(ymdhis)."-".rand(0, 10);
            $chi_name=iconv("BIG-5", "UTF-8", $new_name);
            //echo "</br>已修改為新檔名:".$chi_name."後上傳成功";
            move_uploaded_file($tmp_name, "ads/".$new_name.".".$file[1]);

            $row[point]-=30;
            $sql->update('member_table', 'point', $row[point], 'username', $id);
            echo "上傳成功";
        } else {
            echo "檔案太大，上傳失敗";
        }
    } else {
        echo "檔案格式錯誤，上傳失敗";
    }
    //echo '<meta http-equiv=REFRESH CONTENT=1;url=hotboard.php>';
    // echo '<script>';
// echo 'window.location.href="hotboard.php"';
// echo '</script>';
}
echo '<meta http-equiv=REFRESH CONTENT=1;url=hotboard.php>';
?>
</body>
</html>
