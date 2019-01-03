<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html lang="zh">

<head>
  <meta charset="UTF-8">
  <title>Simple and light sign up form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="updatePassword/css/style.css">




</head>

<body>

  <div class="user">
    <header class="user__header">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3219/logo.svg" alt="" />
        <h1 class="user__title">驗證信箱 </h1>
    </header>

    <form class="form" method="post" action="waitCode_finish.php">
      <button class="btn" onclick= history.back() type="button"/>回上一頁</button>
        <div class="form__group">
            <input type="text" placeholder="查看信箱並輸入驗證號碼" class="form__input" name="code"  />
        </div>


        <!--這裡要新增再次輸入密碼-->

        <input class="btn" type="submit" name="button" value="認證" />

    </form>
</div>



    <script  src="register/js/index.js"></script>




</body>

</html>
