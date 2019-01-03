<?php
    session_start();
    $searchname=$_POST['name'];
    $groupname=$_GET['groupname'];
    $username=$_SESSION["username"];

    include("../mysql_connect.inc.php");
    $json = file_get_contents("online/".$groupname.".json");
    $data=json_decode($json);
?>
<?php
	include("../View.php");
	$view=initView();
	$view->setGroupView();
?>
<head>
	<meta charset="utf-8"/>
</head>
<html>
	<body>
		<div class="searchall">
			<ul>
				<?php
                    if ($searchname==null) {
                        for ($i=0;$i<count($data->data);$i++) {
                            ?>
							<li><?php if ($data->data[$i]->name!=null) {
                                echo $data->data[$i]->name;
                            } else {
                                echo $data->data[$i]->username;
                            } ?>
								<a href="../friend/addfriend.php?friendusername=<?=$data->data[$i]->username?>&friendname=<?=$data->data[$i]->name?>">+</a>
							</li>
				<?php
                        }
                    } else {
                        $name_query="SELECT * FROM member_table where name like '$searchname%' OR username like '$searchname%'";
                        $result=mysql_query($name_query);
                        for ($i=0;$i<mysql_num_rows($result);$i++) {
                            $row=mysql_fetch_row($result);
                            $friendname=$row[5];
                            $friendusername=$row[1];
                            //比對線上名單
                            for ($j=0;$j<count($data->data);$j++) {
                                if ($friendusername==$data->data[$j]->username) {
                                    ?>
									<li><?php if ($friendname!=null) {
                                        echo $friendname;
                                    } else {
                                        echo $friendusername;
                                    } ?>
										<a href="../friend/addfriend.php?friendusername=<?=$friendusername?>&friendname=<?=$friendname?>">+</a>
									</li>
							<?php
                                }
                            }
                        }
                    }
                ?>
			</ul>
		</div>
	</body>
</html>
