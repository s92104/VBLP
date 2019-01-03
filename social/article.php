<?session_start();
ob_start();
include("sqlClass.php");
$sql = new Mysql();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php  echo '<div style="
    width:600px;
  margin:auto;
  font-size:20px;
">';?>
<body style="border:1px solid black;background:#CD853F">
<table  border=3 width = 100%>
  <?php

  $title = $_GET['title'];
  $board = $_GET['board'];
  // $sql="SELECT * from fun WHERE title =  '$title'";
  // $result = mysql_query($sql);
  $row = $sql->getRow($board, 'title', $title);
  ?>
  <tr>
    <td><?php echo "標題 : " .$row[title]; ?></br>
      <?php echo "作者 : ".$row[writer]; ?> </br>
      <?php echo "時間 : ".$row[time]; ?></br>
    </td>
  </tr>
  </table>
  <br>
  <?php echo nl2br($row[article]); ?></br><br>
  --<br><br>
  <?php
  $comment = json_decode($row[comment]);
  if (is_array($comment) || is_object($comment)) {
      foreach ($comment as $key => $value) {
          if ($value) {
              echo '';
              if ($value->push == "-1") {
                  echo '<span style="color:red">
                  eo4&nbsp&nbsp&nbsp</span>';
              } elseif ($value->push == "1") {
                  echo '<span style="color:#FFFF00">
                  &nbsp酷&nbsp&nbsp&nbsp&nbsp</span>';
              } else {
                  echo '&gt&gt&gt&nbsp&nbsp';
              }
              echo '';
              echo $value->name .' : &nbsp'. $value->say.'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$value->time.'<br>';
          }
      }
  }
  //echo $comment[0]->name .' : &nbsp'. $comment[0]->say.'&nbsp&nbsp&nbsp'.$comment[0]->time;
  //echo $row[4].'<br><br><br>';
  setcookie('title', $row[title], time()+3600, '/');
  setcookie('board', $board, time()+3600, '/');
  ob_end_flush();

  echo "<form name=\"form\" method=\"post\" action=\"comment_finish.php\"><br>";
  echo'<input type="radio" name="push" value="1">推文';
  echo'<input type="radio" name="push" value="-1">噓爆';
  echo'<input type="radio" name="push" value="0" checked="checked">無意見';
  echo "<br><input type=\"text\" placeholder=\"留言\" name=\"comment\"
  maxlength=\"20\" style=\"width: 300px;height:25px;\">";

  echo "</form>";
  echo '</div>';
  ?>
</body>