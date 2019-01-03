

function tower(){

  this.x = width;
  this.top = random(height/4,height/2.5);
  this.buttom = random(height/4,height/2.5);

this.show = function(){

  fill(255, 100, 0);
  rect(this.x ,0,70,this.top);
  rect(this.x ,height-this.buttom,70,this.buttom);
}
this.update = function(){
  if(score > 15)
  {
    this.x -= 12;
    speed = 30;
  }
  else if(score > 5)
  {
    this.x -= 8;
    speed = 50;
  }
  else
    this.x -= 5;
}
this.hit = function(bird){
  if(bird.y < this.top || bird.y > height-this.buttom)
  {
    if(bird.x > this.x && bird.x < this.x+70 )
      return true;
  }
  return false;
}
}
