<!DOCTYPE html>
<?$board = $_GET['board'];
setcookie('board', $board, time()+3600, '/');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html lang="zh">

<head>
  <meta charset="UTF-8">
  <title>Simple and light sign up form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="register/css/style.css">
  <script src="invalid/jquery/jquery-3.2.1.min.js"></script>



</head>

<body>

  <div class="user">
    <header class="user__header">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3219/logo.svg" alt="" />
        <h1 class="user__title">發文 </h1>
    </header>

    <form class="form" method="post" action="submittion_finish.php">
      <button class="btn" onclick= history.back() type="button"/>回上一頁</button>
        <div class="form__group">
            <input type="text" placeholder="[中括弧輸入文章種類]後面是標題" class="form__input"
             name="title"  />
        </div>

        <div class="form__group">
            <textarea  placeholder="內文" class="form__input"  cols="45" rows="15" name="article"/></textarea>
        </div>
        <!--這裡要新增再次輸入密碼-->

        <input class="btn" type="submit" name="button" value="發文" />

    </form>
</div>



    <script  src="register/js/index.js"></script>
    <script  src="invalid/js/validmain.js"></script>



</body>

</html>
