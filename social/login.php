<!DOCTYPE html>
<?php session_start();
if ($_SESSION['username']!= null) {
    echo "<script>history.back();</script>";//已經登入後就不可以繼續登入
}?>
<?php
	include("View.php");
	$view=initView();
	$view->setLoginView();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html lang="zh-TW">
<head>
  <title>Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="login/images/icons/favicon.ico"/>
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

  <link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->

  <link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">

  <link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/css/util.css">
  <!--===============================================================================================-->
</head>
<body>

  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-pic js-tilt" data-tilt>
          <img src="login/images/img-01.png" alt="IMG">
        </div>

        <div class="login100-form validate-form">
          <form method="post" action="connect.php">
            <span class="login100-form-title">
              會員登入
            </span>

            <div class="wrap-input100 validate-input" data-validate = "不能有奇怪符號">
              <input class="input100" type="text" name="id" placeholder="Username">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-user" aria-hidden="true"></i>
              </span>
            </div>

            <div class="wrap-input100 validate-input" data-validate = "不能有奇怪符號">
              <input class="input100" type="password" name="pw" placeholder="Password">
              <span class="focus-input100"></span>
              <span class="symbol-input100">
                <i class="fa fa-lock" aria-hidden="true"></i>
              </span>
            </div>





            <div class="container-login100-form-btn">
              <!--<button class="login100-form-btn" type="submit">-->
              <input class="login100-form-btn" type="submit" name="button" value="Login"  >


            </div>

          </form>

          <script>



          </script>

          <!-- <div id="fb-root"></div> -->
          <!-- <div id="spinner"
          style="
          background: #4267b2;
          border-radius: 25px;
          color: white;
          height: 50px;
          text-align: center;
          width: 100%;"> -->
          <div id = "spinner" class = "btn">
            <div class="fb-login-button"
            data-width="50"
            data-max-rows="1"
            data-size="large"
            data-button-type="login_with"
            data-show-faces="false"
            data-auto-logout-link="false"
            data-use-continue-as="false"
            scope="public_profile,email"
            onlogin="checkLoginState()"></div></div>

            <script type="text/javascript" src="fb_auth.js"></script>
            <script type="text/javascript" src="login.js"></script>

            <!-- 這裡是自己定義的GOOGLE按鈕-->
            <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
            <script src="https://apis.google.com/js/api:client.js"></script>
            <script>
            var googleUser = {};
            var startApp = function() {
              gapi.load('auth2', function(){
                // Retrieve the singleton for the GoogleAuth library and set up the client.
                auth2 = gapi.auth2.init({
                  client_id: '979204064740-04ljl9u2eb3h0ltr7c211cgr06s3191v.apps.googleusercontent.com',
                  cookiepolicy: 'single_host_origin',
                  // Request scopes in addition to 'profile' and 'email'
                  //scope: 'additional_scope'
                });
                attachSignin(document.getElementById('customBtn'));
              });
            };

            function attachSignin(element) {
              console.log(element.id);
              auth2.attachClickHandler(element, {},
                function(googleUser) {
                  // document.getElementById('name').innerText = "Signed in: " +
                  //     googleUser.getBasicProfile().getName();
                  var profile = googleUser.getBasicProfile();//google登入成功畫面
                  var id= "G" + profile.getId().substring(0,15);//ID不能超過16位數
                  window.location.href = "register_finish.php?genre=Google"+"&id=" +id+
                  "&email=" + profile.getEmail() + "&name=" +profile.getGivenName();
                }, function(error) {
                  alert(JSON.stringify(error, undefined, 2));
                });
              }

              </script>
            </head>
            <body>
              <!-- In the callback, you would hide the gSignInWrapper element on a
              successful sign in -->
              <div id="gSignInWrapper" class ="google_btn">
                <div id="customBtn" class="customGPlusSignIn">
                  <span class="icon"></span>
                  <span class="buttonText">Log in with Google</span>
                </div>
              </div>
              <div id="name"></div>
              <script>startApp();</script>
              <!-- 以上是自己定義的-->




              <div class="text-center p-t-12">
                <span class="txt1">
                  Forgot
                </span>
                <a class="txt2" href="forgot.php">
                  Username / Password?
                </a><br><br>
                <a class="txt2" href="register.php">
                  Create your Account
                  <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                </a>
              </div>

            </div>
          </div>
        </div>
      </div>




      <!--===============================================================================================-->
      <script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
      <!--===============================================================================================-->
      <script src="login/vendor/bootstrap/js/popper.js"></script>
      <script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
      <!--===============================================================================================-->
      <script src="login/vendor/select2/select2.min.js"></script>
      <!--===============================================================================================-->
      <script src="login/vendor/tilt/tilt.jquery.min.js"></script>
      <script >
      $('.js-tilt').tilt({
        scale: 1.1
      })
    </script>
    <!--===============================================================================================-->
    <script src="login/js/main.js"></script>

  </body>
  </html>
