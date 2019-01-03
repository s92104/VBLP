var score=0;
var bird;
var pipes=[];
var stoped=false;
var fre;
function setup() {
  createCanvas(1200,800);
  bird=new Bird();
  pipes.push(new Pipe());
  fre=random(70,100);
}

function draw() {
  background(155);
  if(stoped){
    fill(0,0,0);
    textSize(100);
    text("HIT!!\nLOSER!!",width/2-200,height/2);
  }else {
    fill(0,0,0);
    textSize(100);
    text(score,200,200);
  }
  if(frameCount%parseInt(fre)==0&&!stoped){
    frameCount=0;
    pipes.push(new Pipe());
  fre=random(70,100);
  }
  for(var i=pipes.length-1;i>=0;i--){
    pipes[i].show();
    if(!stoped){
      pipes[i].update();
    if(pipes[i].hit(bird)){
      bird.fall();
      bird.x-=20;
      stoped=true;

    }
    if(stoped){
      break;
    }
    if(pipes[i].finished()){
      pipes.splice(i,1);
    }
  }
}
  bird.show();
  bird.update();
}
function keyPressed(){
  if(key ==' ') {
    bird.flip();
  }
}
