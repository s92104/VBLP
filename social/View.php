<?php

function initView()
{
	return new View1();
}

abstract class View
{
	public abstract function setIndexView();
	public abstract function setBoardView();
	public abstract function setFriendView();
	public abstract function setGroupView();
	public abstract function setLoginView();
	public abstract function setPickcardView();
}

class View1 extends View
{
	public function setIndexView()
	{
		echo "<link href='index.css' rel='stylesheet' type='text/css'>";
	}
	public function setBoardView()
	{
		echo "<link href='board/css/board.css' rel='stylesheet' type='text/css'>";
		echo "<link href='css/boardlist.css' rel='stylesheet' type='text/css'>";
	}
	public function setFriendView()
	{
		echo "<link href='friend/css/friend.css' rel='stylesheet' type='text/css'>";
		echo "<link href='css/searchlist.css' rel='stylesheet' type='text/css'>";
	}
	public function setGroupView()
	{
		echo "<link href='group/css/group.css' rel='stylesheet' type='text/css'>";
		echo "<link href='css/addgroupform.css' rel='stylesheet' type='text/css'>";
		echo "<link href='css/searchlist.css' rel='stylesheet' type='text/css'>";
		echo "<link href='css/groupinviteform.css' rel='stylesheet' type='text/css'>";
	}
	public function setLoginView()
	{
		echo " <link rel='stylesheet' type='text/css' href='login/css/login.css'>";
	}
	public function setPickcardView()
	{
		echo "<link href='css/pickcard.css' rel='stylesheet' type='text/css'>";
	}
}

class View2 extends View
{
	public function setIndexView()
	{
		echo "<link href='social/view2/index.css' rel='stylesheet' type='text/css'>";
	}
	public function setBoardView()
	{
		echo "<link href='view2/board/css/board.css' rel='stylesheet' type='text/css'>";
		echo "<link href='../view2/board/css/boardlist.css' rel='stylesheet' type='text/css'>";
	}
	public function setFriendView()
	{
		echo "<link href='view2/friend/css/friend.css' rel='stylesheet' type='text/css'>";
		echo "<link href='../view2/friend/css/searchlist.css' rel='stylesheet' type='text/css'>";
	}
	public function setGroupView()
	{
		echo "<link href='view2/group/css/group.css' rel='stylesheet' type='text/css'>";
		echo "<link href='../view2/group/css/addgroupform.css' rel='stylesheet' type='text/css'>";
		echo "<link href='../view2/group/css/searchlist.css' rel='stylesheet' type='text/css'>";
		echo "<link href='../view2/group/css/groupinviteform.css' rel='stylesheet' type='text/css'>";
	}
	public function setLoginView()
	{
		echo " <link rel='stylesheet' type='text/css' href='view2/login/css/login.css'>";
	}
	public function setPickcardView()
	{
		echo "<link href='../view2/pickcard/css/pickcard.css' rel='stylesheet' type='text/css'>";
	}
}
?>