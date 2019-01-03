<?php session_start(); ?>
<?include("../sqlClass.php");

$sql = new Mysql();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

$id = $_SESSION['username'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$school = $_POST['school'];
$major = $_POST['major'];
$FBname = $_POST['FBname'];
$interest = $_POST['interest'];
$fun = $_POST['fun'];

$self = array('id' => $id, 'name' => $name, 'gender' => $gender, 'school' => $school
, 'major' => $major, 'FBname' => $FBname, 'interest' => $interest, 'fun' => $fun);

$self = json_encode($self, JSON_UNESCAPED_UNICODE);

//echo 'id2='.$id;
function exist($rows)
{
    if ($rows != "") {//有人使用
        return true;
    } else {
        return false;
    }
}
$rows = $sql->getRow('pickcard', 'name', $id);
if (exist($rows)) {
    $sql->update('pickcard', 'self', $self, 'name', $id);
} else {
    $sql->exe("INSERT INTO pickcard(name,self) values ('$id','$self')");
}
echo 'OK'.'<meta http-equiv=REFRESH CONTENT=2;url=pickcard.php>';
?>
