<!DOCTYPE html>
<?php session_start();
include("mysql_connect.inc.php");
//取出使用者資料
$id = $_SESSION['username'];
$sql = "SELECT * FROM member_table where username = '$id'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
define("No", 0);
define("username", 1);
define("email", 3);
define("point", 4);
define("name", 5);
define("genre", 6);
define("emailVerify", 7);
define("verifyCode", 8);
?>
<?php if ($_SESSION['username']== null) {
    echo "<script>history.back();</script>";//排除路人
}?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>User</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 放CSS -->
  <link rel="stylesheet" type="text/css" href="member/css/user.css">
  <link rel="stylesheet" type="text/css" href="member/css/boot.css">

  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

</head>



<body class="body2">
  <div class="container">
    <div class="row">
      <div class="col-md-5  toppad  pull-right col-md-offset-3 ">

        <!-- 右上角的 -->
        <p>
          <A href="../logout.php">登出</A></br>
          您好！歡迎進入會員中心!
        </p>
        <!-- 右上角的 -->

        <br>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >


        <div class="panel panel-info">
          <div class="panel-heading">
            <h3 class="panel-title">會員資料中心</h3>
          </div>

          <div class="panel-body">
            <div class="row">
              <!-- 放使用者照片的 -->
              <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="./user.png" class="img-circle img-responsive"> </div>



              <div class="col-md-9 col-lg-9">
                <table class="table table-user-information">
                  <tbody>
                    <tr>
                      <td style="font-weight:bold;">會員名稱</td>
                      <?if ($row[6] == 'Local') {
    ?>
                        <td><?echo $row[username]?></td>
                        <?php
} else {
        ?>
                        <td><?php echo $row[name]?></td>
                        <?php
    }?>
                      <!-- <td><a href="###########">修改名稱</a></td> -->
                    </tr>

                    <tr>
                      <td style="font-weight:bold;">Email</td>
                      <td><?echo $row[email].'&nbsp&nbsp&nbsp';
                      if ($row[emailVerify]) {
                          echo "已認證";
                      } else {
                          echo'<a href = "verifyEmail.php?email='.$row[email].'">認證信箱</a>';
                      }?></a></td>
                      <!-- <td><a href="###########">修改郵箱</a></td> -->
                    </tr>
                    <td style="font-weight:bold;">修改</td>
                    <td><?if ($row[genre] == 'Local') {
                          echo '<a href = "updatePassword.php">修改密碼</a>'.'&nbsp&nbsp&nbsp';
                          echo '<a href = "updateEmail.php">修改Email';
                      }?></td>>
                    <!-- <td><a href="###########">修改電話</a></td> -->
                  </td>

                </tr>

                <tr>
                  <td style="font-weight:bold;">登入方式</td>
                  <td><?echo $row[genre]?></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;">擁有台科B</td>
                  <td><?echo $row[point]?></td>
                </tr>
                <tr>
                  <td style="font-weight:bold;">會員權限</td>
    <td><?if ($row[No]) {
                          echo '管理員';
                      } else {
                          echo '一般會員';
                      }?></td>
                </tr>


                <script language="javascript">
                var Today=new Date();
                document.write(Today.getFullYear()+ "年" +
                (Today.getMonth()+1) + "月" + Today.getDate() + "日");
                </script>
              </tbody>
            </table>

            <!-- 這裡可以加按鈕 -->
            <?php if ($row[No] == 1) {
                          ?>
            <a href="account3.php" class="btn btn-primary">會員管理中心</a>
          <?php
                      }?>
            <a href="dealDetail.php?id=<?echo $id?>" class="btn btn-primary">追蹤貼文</a>
            <a href="bird game/index.html" class="btn btn-primary">小遊戲</a>
          </div>
        </div>
      </div>
    </div>
    <!-- 框框外  -->
  </div>
</div>
</div>
</body>
</html>
