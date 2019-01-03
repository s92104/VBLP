var y=document.getElementById("y");
var mo=document.getElementById("mo");
var d=document.getElementById("d");
var h=document.getElementById('h');
var m=document.getElementById('m');
var s=document.getElementById('s');

var x=setInterval(function(){
	var now=new Date();
	var years=now.getYear();
	var months=now.getMonth();
	var days=now.getDate();
	var hours=now.getHours();
	var mins=now.getMinutes();
	var secs=now.getSeconds();
	
	y.innerHTML=years+1900;
	mo.innerHTML=twoNum(months+1);
	d.innerHTML=twoNum(days);
	h.innerHTML=twoNum(hours);
	m.innerHTML=twoNum(mins);
	s.innerHTML=twoNum(secs);
},1000);

function twoNum(x)
{
	if(x<10)
		return '0'+x;
	return x;
}