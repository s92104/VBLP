  <?php session_start();ob_start() ?>
  <!--上方語法為啟用session，此語法要放在網頁最前方-->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <?php
  //連接資料庫
  //只要此頁面上有用到連接MySQL就要include它
  include("mysql_connect.inc.php");
  include("loading.php");
  $id = $_POST['id'];
  $pw = $_POST['pw'];

  //用google or facebook連結上網站
  $genre = $_GET['genre'];
  $specialid = $_GET['id'];


  //搜尋資料庫資料
  function data($id)
  {
      $sql = "SELECT * FROM member_table where username = '$id'";
      $result = mysql_query($sql);
      $row = @mysql_fetch_row($result);
      return $row;
  }
  $row = data($id);
  if ($specialid!=null) {
      $_SESSION['username'] = $specialid;
      //echo $genre.'登入成功!';
      loading($genre.'<br>登入成功!'); ?>
    <script language="JavaScript">
    opener.location.reload();
    window.setTimeout("window.close()",1000);
    </script>
    <?php
    //取出使用者資料
    $username=$_SESSION['username'];
      $name_query = "SELECT * FROM member_table where username='$username'";
      $result = mysql_query($name_query);
      $row=mysql_fetch_row($result);
      $name=$row[5];

      $name_query = "SELECT * FROM group_table where name='$username'";
      $result = mysql_query($name_query);
      $row=mysql_fetch_row($result);
      $json=$row[1];
      $data=json_decode($json);
      //線上
      for ($i=0;$i<count($data->data);$i++) {
          $onlinefile="group/online/".$data->data[$i]->name.".json";
          $json_old =file_get_contents($onlinefile);
          $newdata=json_decode($json_old);
          //檢查重複
          for ($j=0;$j<count($newdata->data);$j++) {
              if ($newdata->data[$j]->username==$username) {
                  $repeat=true;
              }
          }
          //放東西
          if (!$repeat) {
              array_push($newdata->data, array("username"=>$username,"name"=>$name));
              //$json_new=urlencode($newdata);
              $json_new=json_encode($newdata, JSON_UNESCAPED_UNICODE);
              file_put_contents($onlinefile, $json_new);
          }
          $repeat=false;
      }
  }
  //判斷帳號與密碼是否為空白
  //以及MySQL資料庫裡是否有這個會員
  elseif ($id != null && $pw != null && $row[1] == $id && $row[2] == $pw) {
      //將帳號寫入session，方便驗證使用者身份
      $_SESSION['username'] = $id;
      //echo '登入成功!';
      loading('登入成功!'); ?>
    <script language="JavaScript">
    opener.location.reload();
    window.setTimeout("window.close()",1000);
    </script>
    <?php
    //取出使用者資料
    $username=$_SESSION['username'];
      $name_query = "SELECT * FROM member_table where username='$username'";
      $result = mysql_query($name_query);
      $row=mysql_fetch_row($result);
      $name=$row[5];

      $name_query = "SELECT * FROM group_table where name='$username'";
      $result = mysql_query($name_query);
      $row=mysql_fetch_row($result);
      $json=$row[1];
      $data=json_decode($json);
      //線上
      for ($i=0;$i<count($data->data);$i++) {
          $onlinefile="group/online/".$data->data[$i]->name.".json";
          $json_old =file_get_contents($onlinefile);
          $newdata=json_decode($json_old);
          //檢查重複
          for ($j=0;$j<count($newdata->data);$j++) {
              if ($newdata->data[$j]->username==$username) {
                  $repeat=true;
              }
          }

          //放東西
          if (!$repeat) {
              array_push($newdata->data, array("username"=>$username,"name"=>$name));
              $json_new=json_encode($newdata, JSON_UNESCAPED_UNICODE);
              file_put_contents($onlinefile, $json_new);
          }
          $repeat=false;
      }
      //echo '<meta http-equiv=REFRESH CONTENT=1;url=member/member.php>';
  } else {
      loading('登入失敗!');
      echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
  }
  ?>
	 <meta http-equiv=REFRESH CONTENT=1;url=index.php>
