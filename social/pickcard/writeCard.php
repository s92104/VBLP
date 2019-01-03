<?php session_start(); ?>
<?include("../sqlClass.php");

$sql = new Mysql();
$id = $_SESSION['username'];
$row = $sql->getRow('pickcard', 'name', $id);
$card = json_decode($row[1]);
?>
<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html lang="zh">

<head>
  <meta charset="UTF-8">
  <title>card</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="register/css/style.css">
  <script src="../invalid/jquery/jquery-3.2.1.min.js"></script>




</head>

<body>

  <div class="user">
    <header class="user__header">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3219/logo.svg" alt="" />
        <h1 class="user__title">寫卡片 </h1>
    </header>

    <form class="form" method="post" action="writeCard_finish.php">
      <button class="btn" onclick= history.back() type="button"/>回上一頁</button>
      <div class="form__group">
          <input type="text" placeholder="名子" class="form__input" name="name" value="<?echo $card->name?>"/>
      </div>
      <div class="form__group">
          <input type="text" placeholder="性別" class="form__input" name="gender"  value="<?echo $card->gender?>"/>
      </div>
        <div class="form__group">
            <input type="text" placeholder="學校" class="form__input" name="school" value="<?echo $card->school?>" />
        </div>
        <div class="form__group">
            <input type="text" placeholder="系別" class="form__input" name="major"  value="<?echo $card->major?>"/>
        </div>

        <div class="form__group">
            <input type="text" placeholder="FBname" class="form__input" name="FBname" value="<?echo $card->FBname?>"/>
        </div>
        <div class="form__group">
            <textarea  placeholder="至少列出3個興趣，找出你們相同的興趣" class="form__input"  cols="45" rows="5" name="interest"/><?echo $card->interest?></textarea>
        </div>
        <div class="form__group">
            <textarea  placeholder="講一個笑話讓他知道你有多幽默" class="form__input"  cols="45" rows="8" name="fun"/><?echo $card->fun?></textarea>
        </div>



        <!--這裡要新增再次輸入密碼-->

        <input class="btn" type="submit" name="button" value="提交卡片" />

    </form>
</div>



    <script  src="register/js/index.js"></script>
    <script  src="../invalid/js/validmain.js"></script>



</body>

</html>
