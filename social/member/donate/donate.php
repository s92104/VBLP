<!DOCTYPE html>
<?php session_start();
include("../mysql_connect.inc.php");
$t = $_GET['t'];
$id = $_SESSION['username'];
$sql = "SELECT * FROM member_table where username = '$id'";
$result = mysql_query($sql);
$row = @mysql_fetch_row($result);
$nowpoint = $row[4];
if ($row[7] == false) {
    echo '您的信箱還沒經過驗證喔，請去會員中心認證您信箱'; ?>
  <script language="JavaScript">
  window.setTimeout("window.close()",2500);  
  </script>
  <?php
} else {
        ?>
<html>
<head>
<title>donate</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
  <?php

  ?>
  <H1>你現在擁有<?echo $nowpoint; ?>點</H1>

<div class="wrapper row3">
  <main class="hoc container clear">
    <ul class="nospace group services">
      <li class="one_third first active">
        <article class="bgded overlay">
          <p style="color: white" >這文章還不錯，我要給他1點！</p>
          <img src="images/coin.jpg" >

          <footer><a href = "#" onclick="donate_1('<?echo $t?>')">捐個1點！ &raquo;</a></footer>
      </li>
      <li class="one_third active">

          <article class="bgded overlay">
          <p style="color: white ">這文章太棒了，我要給他5點！</p>
          <img src="images/coins.jpg" height="500">

          <footer><a href = "#" onclick="donate_5('<?echo $t?>')">捐個5點！ &raquo;</a></footer>
        </article>
      </li>
      <li id= "li3"  class="one_third active">

        <article class="bgded overlay">
          <p style="color: white ">自行選擇點數</p>
          <img src="images/question.jpg">
           <div class="select">
             <select name="donate"  onchange="donate_select(this.value,'<?echo $t?>');">
               <?if ($nowpoint <= 0) {
      ?>
               <option value="" >您已經沒有點數囉</option>
               <?php
  } else {
      ?>
               <option value="-1" >請選擇</option>
               <?php
  }
        for ($var = 1;$var <= $nowpoint;$var++) {
            ?>
                 <option value="<?echo $var?>" > <?echo $var?>點 </option>
               <?php
        } ?>
             </select>
           </div>
         <footer><a>點選上面點數後會自動送出 &uArr;</a></footer>
      </li>
    </ul>
    <div class="clear"></div>
  </main>
</div>
<script type="text/javascript">
  function donate_1(title){

    if(<?echo $nowpoint?> <= 0)
    {
      alert("妳的點數不夠喔");
    }
    else
    {
      if(confirm("確定要捐出1點給\n"+title))
        window.location.href = "../givePoint_finish.php?donate=1&t="+title;
    }
  }
  function donate_5(title){
    if(<?echo $nowpoint?> <= 0)
    {
      alert("妳的點數不夠喔");
    }
    else
    {
      if(confirm("確定要捐出5點\n"+title))
        window.location.href="../givePoint_finish.php?donate=5&t="+title;
    }
  }
  function donate_select(value,title){
    if(value!=-1)
    if(confirm("確定要捐出"+value+"點給\n"+title))
      window.location.href="../givePoint_finish.php?donate="+value+"&t="+title;
  }
</script>
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<script src="layout/scripts/jquery.flexslider-min.js"></script>
</body>
</html><?php
    }?>
