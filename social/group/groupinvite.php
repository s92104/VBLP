<?php
    //接收資料
    session_start();
    $username=$_SESSION['username'];
    $friendusername=$_GET['friendusername'];
    $groupname=$_GET['groupname'];

    //先找intro
    include("../mysql_connect.inc.php");
    $group_query="SELECT * FROM group_table where name = '$username'";
    $result=mysql_query($group_query);
    $row=mysql_fetch_row($result);
    $json=$row[1];
    $data=json_decode($json);
    for ($i=0;$i<count($data->data);$i++) {
        if ($data->data[$i]->name==$groupname) {
            $groupintro=$data->data[$i]->intro;
        }
    }

    $group_query="SELECT * FROM group_table where name = '$friendusername'";
    $result=mysql_query($group_query);
    //沒有資料
    if (mysql_num_rows($result)==0) {
        $newdata=array("data"=>array());
        $newjson=json_encode($newdata, JSON_UNESCAPED_UNICODE);
        mysql_query("INSERT INTO group_table (name, groups) VALUES ('$friendusername','$newjson')");
        $result=mysql_query($group_query);
    }
    //新增資料
    $row=mysql_fetch_row($result);
    $json_old=$row[1];
    $data=json_decode($json_old);
    array_push($data->data, array("name"=>$groupname,"intro"=>$groupintro));
    $json_new=json_encode($data, JSON_UNESCAPED_UNICODE);
    mysql_query("UPDATE group_table SET groups='$json_new' where name='$friendusername'");
?>
<script>
	parent.location.href="../group.php";
</script>
