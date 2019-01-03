<?php
    //接收資料
    session_start();
    include("../mysql_connect.inc.php");
    $username=$_SESSION['username'];
    $groupname=$_POST['name'];
    $groupintro=$_POST['intro'];
    //找名字
    $name_query = "SELECT * FROM member_table where username='$username'";
    $result = mysql_query($name_query);
    $row=mysql_fetch_row($result);
    $name=$row[5];
    //建online檔
    $newonline=array("data"=>array(array("username"=>$username,"name"=>$name)));
    file_put_contents("online/".$groupname.".json", json_encode($newonline, JSON_UNESCAPED_UNICODE));

    $group_query="SELECT * FROM group_table where name = '$username'";
    $result=mysql_query($group_query);
    //沒有資料
    if (mysql_num_rows($result)==0) {
        $newdata=array("data"=>array());
        $newjson=json_encode($newdata, JSON_UNESCAPED_UNICODE);
        mysql_query("INSERT INTO group_table (name, groups) VALUES ('$username','$newjson')");
        $result=mysql_query($group_query);
    }
    //新增資料
    $row=mysql_fetch_row($result);
    $json_old=$row[1];
    $data=json_decode($json_old);
    array_push($data->data, array("name"=>$groupname,"intro"=>$groupintro));
    $json_new=json_encode($data, JSON_UNESCAPED_UNICODE);
    mysql_query("UPDATE group_table SET groups='$json_new' where name='$username'");
?>
<script>
	location.href="../group.php";
</script>
