
//按下登入按鈕時，檢查登入狀態
function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}
// var finished_rendering = function() {
//   console.log("finished rendering plugins");
//   var spinner = document.getElementById("spinner");
//   spinner.removeAttribute("style");
//   spinner.removeChild(spinner.childNodes[0]);
// }
// FB.Event.subscribe('xfbml.render', finished_rendering);

function statusChangeCallback(response) {
  console.log('statusChangeCallback');
  console.log(response);
  //如果已經登入就把他帶到index.html
  if (response.status === 'connected') {
    //拿到用戶的token去跟fb要使用者資料
    get_profile(response.authResponse.accessToken);
  //  window.close();
    //document.location.href="index.html";
  }
}

//透過token去跟fb要用戶資料
function get_profile(token) {
  console.log("Welcome!  Fetching your information.... ");
  //field後面的參數取決你要取得用戶的欄位，這邊是取得用戶的 id,name,first_name,last_name,email
  var url = `https://graph.facebook.com/me?fields=id,name,first_name,last_name,email&access_token=${token}`
  var xhr=new XMLHttpRequest();
  xhr.open("GET", url);
  xhr.onreadystatechange=function(){
    if(xhr.readyState === 4 && xhr.status === 200){
      //data就是我們要的用戶資料
      var data = JSON.parse(xhr.responseText);
      //之後你可以做任何你想做的事...例如塞到你的資料庫中
      console.log(data.email);
      console.log(data.id);
      console.log(data.first_name);


        //console.log("connect.php?eamil="+data.email+"&id="
        //+data.id+"&name="+data.first_name);
      var id = "F" + data.id.substring(0,15);//ID不能超過16位數
      window.location.href="register_finish.php?genre=Facebook"+"&id="+id+
      "&email="+data.email+"&name="+data.first_name;


    }
  };
  xhr.send();
}
