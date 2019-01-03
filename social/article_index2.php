<?session_start();
include("sqlClass.php");
$sql = new Mysql();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table  border=2 width = 40%>
<?php

$board = $_GET['board'];
echo '<a href = "submittion.php?board='.$board.'">投搞</a>'.'&nbsp&nbsp&nbsp';
echo "這裡是".$board."版喔!<p>";
// echo '<div style="
//     width:600px;
//   margin:auto;
//   font-size:20px;
// ">';


// $data=mysql_query("SELECT * FROM $board ORDER BY time DESC");
$data = $sql->orderby($board, 'time');
  //$row = @mysql_fetch_row($result);

  for ($i=0;$i<$sql->num_rows($data);$i++) {
      $row=$sql->fetch_row($data); ?>
        <tr>
        <td height=40><?php echo $row[hot].'&nbsp&nbsp'.
        '<a href = "article.php?title='.$row[title].'&board='.$board.'">'
        .$row[title].'</a></br>'; ?>
        </td>
        </tr>

  <?php
  }?>
