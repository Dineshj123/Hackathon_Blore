var j=0,values,height;      var graphCanvas = document.getElementById('graphSpace');
      var maxValue = 0;
  var data = new Array();
  
    function graph(data) {      
var graphCanvas = document.getElementById('graphSpace');
    if (graphCanvas && graphCanvas.getContext) {
        
        var context = graphCanvas.getContext('2d');
  }
  


      context.clearRect ( 0 , 0 , graphCanvas.width, graphCanvas.height );

     

        drawBarChart(context, data, 50, 50, (graphCanvas.height - 20));
        
      
    }
    
    function drawBarChart(context, data, startX, barWidth, chartHeight) {
      context.lineWidth = "1.0";
      var startY = 380;
      drawLine(context, startX, startY, startX, 30); 
      drawLine(context, startX, startY, 870, startY);     
      context.lineWidth = "0.0";
      
      
          startX=70;
        for (var i=0; i < data.length; i++) {

         height = data[i];
        var height1=(height/maxValue)*350;
        context.fillStyle = "#00FAAF";
        drawRectangle(context, startX + (i * barWidth) + i, (chartHeight - height1), barWidth, height1, true,height);
      
      }
      var markerValue=0;
       for (var i=0; i<10; i++) {    
         context.fillText(markerValue, (startX - 35), (chartHeight - markerValue*3.5), 50);
         markerValue += 10;
       }
        
    }   
    
    function drawLine(contextO, startx, starty, endx, endy) {
      contextO.beginPath();
      contextO.moveTo(startx, starty);
      contextO.lineTo(endx, endy);
      contextO.closePath();
      contextO.stroke();
    }
    
    function drawRectangle(contextO, x, y, w, h, fill,text) {      
      contextO.beginPath();
      contextO.rect(x, y, w-5, h);
      contextO.fillText(text,x+(w-4)/2,y-3,w/2);

      contextO.closePath();
      contextO.stroke();
      if (fill) contextO.fill();
    }   
  

function promptfunc()
{
data[j]=prompt();

var sortdata=new Array();
for(var i=0;i<data.length;i++){
  sortdata[i]=data[i];
}
sortdata.sort(function(a, b){return a-b});
maxValue=sortdata[sortdata.length-1];
document.getElementById("graph").innerHTML="Scale-Y-Axis="+"1%="+maxValue/100;
graph(data);
j++;
}  

function promptfunc1()
{


var sortdata=new Array();
for(var i=0;i<data.length;i++){
  sortdata[i]=data[i];
}
sortdata.sort(function(a, b){return a-b});
maxValue=sortdata[sortdata.length-1];
document.getElementById("graph").innerHTML="Scale-Y-Axis="+"1%="+maxValue/100;
graph(sortdata);

}  


function promptfunc2()
{


var sortdata=new Array();
for(var i=0;i<data.length;i++){
  sortdata[i]=data[i];
}
sortdata.sort(function(a, b){return a-b});
maxValue=sortdata[sortdata.length-1];
document.getElementById("graph").innerHTML="Scale-Y-Axis="+"1%="+maxValue/100;
graph(data);

}  
