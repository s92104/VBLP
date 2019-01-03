<?session_start();
include("../sqlClass.php");?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php  echo '<div style="
    width:600px;
  margin:auto;
  font-size:20px;
">';?>
<table  border=3 width = 100%>
  <?php
  $sql = new Mysql();
  $title = $_GET['title'];
  // $sql="SELECT * from fun WHERE title =  '$title'";
  // $result = mysql_query($sql);
  $row = $sql->getRow('fun', 'title', $title);
  ?>
  <tr>
    <td><?php echo "標題 : " .$row[title]; ?></br>
      <?php echo "作者 : ".$row[writer]; ?> </br>
      <?php echo "時間 : ".$row[time]; ?></br>
    </td>
  </tr>
  </table>
  <br>
  <?php echo $row[article]; ?></br><br>
  --<br><br>
  <?php
  $comment = json_decode($row[comment]);
  if (is_array($comment) || is_object($comment)) {
      foreach ($comment as $key => $value) {
          if ($value) {
              echo $value->name .' : &nbsp'. $value->say.'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$value->time.'<br>';
          }
      }
  }
  //echo $comment[0]->name .' : &nbsp'. $comment[0]->say.'&nbsp&nbsp&nbsp'.$comment[0]->time;
  //echo $row[4].'<br><br><br>';
  setcookie('title', $row[title]);
  echo "<form name=\"form\" method=\"post\" action=\"comment_finish.php\"><br>";
  echo "留言：<br><textarea name=\"comment\" cols=\"45\" rows=\"5\"></textarea> <br>";
  echo "<input type=\"submit\" name=\"button\" value=\"確定\" />";
  echo "</form>";
  echo '</div>';
  ?>
