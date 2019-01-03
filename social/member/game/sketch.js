var score=0;
var bird,stuff = [];
var stoped=false;
var speed = 75;

function setup() {
  createCanvas(1200,800);
  bird=new Bird();
    stuff.push( new tower());
}

function draw() {
  background(155);
//if(frameCount%100==0)
  //stuff.push( new tower());
  /*if(frameCount%parseInt(fre)==0&&!stoped){
    frameCount=0;
}*/
    if(stoped){
      for(var i=0;i<stuff.length;i++)
      {
        stuff[i].show();
      }
      bird.show();
      bird.update();
      fill(0,0,0);
      textSize(100);
      text(score,300,300);
      text("HITS!!\n再接再厲!!",width/2-200,height/2);

    }else {
      for(var i=0;i<stuff.length;i++)
      {

          if(stuff[i].x < -70)
            stuff.splice(i,1);
          if(stuff[i].hit(bird))
           stoped = true;
          stuff[i].show();
          stuff[i].update();
      }
        bird.show();
        bird.update();
       if(keyIsDown(UP_ARROW)) {
          bird.flip();
        }
        if(frameCount%speed==0)
        {
          score += 1;
          stuff.push(new tower());
        }

        fill(0,0,0);
        textSize(100);
        text(score,200,200);
    }
}
