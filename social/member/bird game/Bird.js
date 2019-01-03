var vel=0;
var gra=1;
function Bird(){
this.enabled=true;
this.x=200;
this.y=height/2;
this.show=function(){
  fill(255, 204, 0);
  ellipse(this.x,this.y,44,44);//body
  fill(0,0,0);
  ellipse(this.x+10,this.y-4,20,20);//black eye
  fill(255,255,255);
  ellipse(this.x+14,this.y-7,10,10);//white eye
  fill(255,153,0);
  ellipse(this.x+18,this.y+5,24,12);//Mouth
}
this.update=function(){
    vel+=gra;
    this.y+=vel*0.8;
    if(this.y>height){
      this.y=height;
    }else if(this.y<0){
      this.y=0;
      vel=0;
    }
}
this.flip=function(){
  if(this.enabled){
  vel=-10;
}
}
this.fall=function(){
  this.enabled=false;
}
}
