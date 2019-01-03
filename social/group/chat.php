<?php
    session_start();
    include("../sqlClass.php");
    $sql = new Mysql();
    $username=$_SESSION['username'];
        $row=$sql->getRow('member_table', 'username', $username);
        $name=$row[name];
    $filename=$_POST["filename"];
    $text = $_POST["text"];     // 取得表單送出訊息
    $date = date('H:i:s');      // 取得現在時間
    $fp = fopen("message/".$filename, "a+"); // 開啟檔案
    // 建立聊天訊息
        if ($name==null) {
            $name=$username;
        }
    $msg = "<div class='message'><span class='name'>" . $name. ":</span>"
           ."<span class='text'>".stripslashes(htmlspecialchars($text)) ."</span>"
           ."<span class='right'>" . $date ."</span></div>";
    fwrite($fp, $msg);  // 寫入檔案
    fclose($fp);        // 關閉檔案
