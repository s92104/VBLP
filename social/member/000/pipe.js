
var speed=10;
function Pipe(){

this.x=width;
this.w=40;
this.top=random(height/2);
this.bottom=random(height/2);

this.show=function() {
  fill(0,255,0);
  rect(this.x,0,this.w,this.top);
  rect(this.x,height-this.bottom,this.w,this.bottom);
}
this.update=function(){
this.x-=speed;
}
this.hit=function(bird){
if(bird.x>this.x&&bird.x<(this.x+this.w)&&(bird.y<this.top||bird.y>height-this.bottom)){
  return true;
}else {
  if(bird.x==this.x+this.w/2){
  ++score;
}
  return false;
}
}
this.finished=function(){
  if(this.x<-this.w){
    return true;
  }else {
    return false;
  }
}
}
