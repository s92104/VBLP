<?php session_start();
include("member/loading/loading.php");

//清除群組線上
$username=$_SESSION['username'];
include("mysql_connect.inc.php");
//取出使用者資料
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
    //刪東西
    for ($j=0;$j<count($newdata->data);$j++) {
        if ($newdata->data[$j]->username==$username) {
            unset($newdata->data[$j]);
        }
    }
    $json_new=json_encode($newdata, JSON_UNESCAPED_UNICODE);
    file_put_contents($onlinefile, $json_new);
}
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="google-signin-client_id" content="979204064740-04ljl9u2eb3h0ltr7c211cgr06s3191v.apps.googleusercontent.com">

<script type="text/javascript" src="fb_auth.js"></script>
<script type="text/javascript">
function statusChangeCallback(response) {
  console.log('statusChangeCallback');
  console.log(response);

  if (response.status === 'connected') {
    //取得用戶資料，但這種只有name和id
    FB.api('/me', function(response) {
      console.log(response);
      //document.getElementById('status').innerHTML = response.name +'<br/>'+ response.id+ response.email + '歡迎登入';
    });
    //signOut();
    logout();//登出Facebook
  }
}
function logout(){
  FB.logout(function(response) {
      alert('登出成功');
      window.location.reload();
  });
}



</script>

<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>

<script>
function onLoad() {
   gapi.load('auth2', function() {
   gapi.auth2.init().then(()=>{signOut();});//登出doodle api


   });
  }
   function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }

</script>
<!-- <script type="text/javascript" src="https://mail.google.com/mail/u/0/?logout&hl=en" /></script> -->
<?php
//將session清空
unset($_SESSION['username']);
loading("登出中......");
//echo '登出中......';
//echo '<a onclick = "signOut();"> 登出';
//echo '<meta http-equiv=REFRESH CONTENT=1;url=../index.php>';
?>

</body>
</html>
<script>
setInterval(function () {
	location.href="index.php";
}, 1000);

</script>
