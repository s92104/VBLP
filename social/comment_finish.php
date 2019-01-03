  <?php session_start();
  include("sqlClass.php");
  $sql = new Mysql();

  $say = $_POST['comment'];
  $push = $_POST['push'];

  $id = $_SESSION['username'];

  $title = $_COOKIE['title'];
  unset($_COOKIE['title']);


  $board = $_COOKIE['board'];
  unset($_COOKIE['board']);

  date_default_timezone_set("Asia/Taipei");
  $time = date("Y-m-d  G:i:s");

  // echo $title;
  // echo $board;
  $rex = '/[^<>\'"~`\/\\\\();*%$&#=-]/m';
  preg_match_all($rex, $say, $matches);
  //echo $matches[1][0];
  if (strlen($say) != count($matches[0])) {
      echo '不能有奇怪字元';
      echo '<script>';
      echo 'setInterval(function () {
      	history.back();
      }, 1000);';
      echo '</script>';
  } else {
      $jason = array('name' => $id, 'say' => $say, 'time' => $time, 'push' => $push);


      //$comment = json_encode($jason, JSON_UNESCAPED_UNICODE);


      // $sql="SELECT * from $board WHERE title =  '$title'";
      // $result = mysql_query($sql);
      $row = $sql->getRow($board, 'title', $title);

      $decode = json_decode($row[comment], true);
      $decode[] = $jason;
      //$comment = $decode;

      // echo $row[article];
      $comment = json_encode($decode, JSON_UNESCAPED_UNICODE);


      //s$sql = "UPDATE $board SET comment = '$comment' WHERE title =  '$title'";
      function updateHot($sql, $board, $title, $push)
      {
          $row=$sql->getRow($board, 'title', $title);//下面三行在計算hot點數
          $row[hot] += (int)$push;
          $sql->update($board, 'hot', $row[hot], 'title', $title);
      }
      function giveWriter($sql, $row, $push)
      {
          $row=$sql->getRow('member_table', 'username', $row[writer]);//下面三行給作者台科B
          $row[point] += (int)$push>0?1:0;
          $sql->update('member_table', 'point', $row[point], 'username', $row[writer]);
      }
      if ($say != null) {
          $sql->update($board, 'comment', $comment, 'title', $title);
          updateHot($sql, $board, $title, $push);
          giveWriter($sql, $row, $push); ?>
        <script>
        //echo 'opener.location.reload()';
        //window.location.href = "<?echo $board?>/<?echo $board?>.php?title="+'<?echo $title?>';
        //window.history.forward(1);
        history.go(-1);
        //  echo 'history.back()';
        </script><?php
      } else {
          echo '<script>';
          echo 'history.back()';
          echo '</script>';
      }
  }
