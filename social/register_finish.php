<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");
include("member/loading/loading.php");


$getgenre = $_GET['genre'];
if ($getgenre != null) {
    //echo '我收到'.$getgenre;
    $id = $_GET['id'];//非本網站上註冊
    //echo 'id='.$id;
} else {
    //echo '我非收到'.$getgenre;
    $id = $_POST['id'];//本網站上註冊
}

//抓取本網站上註冊表單的值
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];
$email = $_POST['email'];

//抓google或者facebook的帳號的值
$getemail = $_GET['email'];
$getname = $_GET['name'];


$chk = "SELECT * FROM member_table where username = '$id'";
$abc = mysql_query($chk);
$rows = mysql_num_rows($abc);
//echo 'id2='.$id;
function exist($rows)
{
    if ($rows != "") {//有人使用
        return true;
    } else {
        return false;
    }
}
function existMail($email)
{
    $chk = "SELECT * FROM member_table where email = '$email'";
    $abc = mysql_query($chk);
    $rows = mysql_num_rows($abc);
    return exist($rows);
}
if ($getgenre != null) {//用第三方網站登入+"&genre="+<?echo $getgenre
    if (exist($rows)) {//之前有登入過的?>
		<script>//幫他轉到connect頁面讓他登入成功
		type = '<?echo $getgenre?>';
		window.location.href = "connect.php?id="+'<?echo $id?>'+"&genre="+type;
		</script>
	<?php
    } else {//之前沒有登入過，現在是第一次登入，幫他新註冊一個帳號
        $point = 20;
        $sql = "INSERT into member_table (token, username, email, point,name,genre,emailVerify)
								values ('0','$id', '$getemail', '$point', '$getname','$getgenre',true)";
        if (mysql_query($sql)) {
            //echo '新增成功!';
            loading("新增成功!");
            echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
        } else {
            //echo '新增失敗!';
            loading("新增失敗!");
            echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
        }
    }
} else {//從本網站註冊帳號，所以genre會是空的
    if (exist($rows) || existMail($email)) {//如果這帳號或者信箱已經有人註冊過了
        //echo '您的帳號或者信箱已經有人使用了!';
        loading("您的帳號或者信箱已經有人使用了!");
        echo '<meta http-equiv=REFRESH CONTENT=2;url=register.php>';//幫他轉回註冊頁面
    } elseif ($id != null && $pw != null && $pw2 != null && $pw == $pw2 && $email != null) {//沒有人註冊過，檢查條件後幫她註冊一個
            $point = 20;
        $sql = "insert into member_table (token, username, password, email, point, genre, emailVerify) values
				('0','$id', '$pw', '$email', '$point', 'Local', false)";
        if (mysql_query($sql)) {
            //echo '新增成功!';
            loading("新增成功!");
            echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
        } else {
            //echo '新增失敗!';
            loading("新增失敗!");
            echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
        }
    } else {//他亂搞一通，都沒有填寫好，或是它是一個路人甲
        //echo '您無權限觀看此頁面或者密碼不一致!';
        loading("您無權限觀看此頁面或者密碼不一致!"); ?>
					<script>
	        	window.setTimeout("history.back()",1000);
					</script>
					<?php
    }
}

?>
