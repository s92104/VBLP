<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<marquee behavior=alternate bgcolor=bdcc05><font color = blue><font size = 20>管理管理管理
</marquee> </p></font>
<table  border=1 width = 40%>
<tr>
<td>使用者</td>
<td>Email</td>
<td>剩餘點數</td>

</tr>

<?include("mysql_connect.inc.php");?>
<?php

//此判斷為判定觀看此頁有沒有權限
//說不定是路人或不相關的使用者
//因此要給予排除
if ($_SESSION['username'] != null) {
    echo "歡迎".$_SESSION['username']."管理人員</p>"; ?>
        <a href = "member.php">返回首頁</a><br><br>
        <form name="form" method="post" action="addPoint.php">
        使用者名稱 : <input type = "text" name="name"/> <br>
        儲值點數 : <input type="int" name="point" /> <br>
        <input type="submit" name="button" value="分配" />
        </form>
        <?php
          $id = $_SESSION['username'];
    //將資料庫裡的所有會員資料顯示在畫面上
    $data=mysql_query("SELECT * from member_table");
    //$row = @mysql_fetch_row($result);
    for ($i=1;$i<=mysql_num_rows($data);$i++) {
        $row=mysql_fetch_row($data); ?>
              <tr>
              <td><?php echo $row[1]; ?></td>
              <td><?php echo $row[3]; ?></td>
              <td><?php echo $row[4]; ?></td>
              </tr>
            <?
    }
} else {
    echo '您無權限觀看此頁面!';
    echo '<meta http-equiv=REFRESH CONTENT=1;url=../index.php>';
}
?>
</table>
