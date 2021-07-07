function setup() {
	var canvas = createCanvas(500, 500);
  canvas.parent('canvas');
    fill(255,0,0);
    rect(0, 0, 260, 50);
    text('Dogs - 260', 0, 75);
    fill(0,255,0);
    rect(0, 100, 300, 50);
    text('Cats - 300', 0, 175);
    fill(0,0,255);
    rect(0, 200, 100, 50);
    text('Hamsters - 100', 0, 275);
    fill(200,100,0);
    rect(0, 300, 50, 50);
    text('Rabbits - 50', 0, 375);
    fill(0,200,200);
    rect(0, 400, 10, 50);
    text('Spiders - 10', 0, 475);
  }