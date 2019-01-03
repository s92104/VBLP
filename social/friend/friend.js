function delete_confirm(friendusername)
{
	if(confirm("確定刪除好友?"))
		document.location.href="deletefriend.php?friendusername="+friendusername;
}