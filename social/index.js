//檢查登入狀態
function statusChangeCallback(response) {
  console.log('statusChangeCallback');
  console.log(response);
  if (response.status === 'connected') {
    //取得用戶資料，但這種只有name和id
    FB.api('/me', function(response) {
      console.log(response);
      //document.getElementById('status').innerHTML = response.name +'<br/>'+ response.id+ response.email + '歡迎登入';
    });
  }
}

//登出按鈕
function logout(){
  FB.logout(function(response) {
      alert('登出成功');
      window.location.reload();
  });
}
