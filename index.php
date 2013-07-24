<!DOCTYPE HTML>
<head>
 	

 	<script src="../jquery-2.0.1.min.js"></script>
 	<script src="raphael-min.js"></script>
	<script src="rgbcolor.js"></script>
	<script src="canvg.js"></script>
	<script src="StackBlur.js"></script>
	<script src="svg.min.js"></script>

 	
<style>
 
body{
	background: url(../wnoise.jpg);
	font-family: sans-serif;
	font-weight: 800;
	color: #333;
	margin: 0;
	overflow-y:hidden;
}

h1 {
	font-size: 1.3em;
	text-align: left;
	-webkit-margin-start: 20px;
}

li {
	list-style:none;
	cursor: pointer;
	float: left;
	width: 100%;
	text-align: left;
}

li:hover {
	background: #ff6100;
}

ul, menu, dir {
	display: block;
	list-style-type: disc;
	-webkit-margin-before: 0;
	-webkit-margin-after: 0;
	-webkit-margin-start: 20px;
	-webkit-margin-end: 0;
	-webkit-padding-start: 0;
	-webkit-user-select: none;
	height: 10%;
}

.darken{
	height: 100%;
	width: 10%;
	position: absolute;
	background: #000;
	opacity: 0.8	;
}

.sidebar {
	position: absolute;
	margin: 0;
	width: 10%;
	height: 100%;
	color: #eee;
	-webkit-user-select: none;
}


#clearbtn {
	cursor: pointer;
}

#clearbtn:hover {
	background: #ff6100;
}


/***********MAPS***************/

#maps{
	text-align: left;
	position: absolute;
	top: 150px;
}

.map {
	height: 18px;
	-webkit-margin-start: 20px;
}

.map:hover {
	cursor: pointer;
	background: #ff6100;
}



/************DRAW**************/
#canvas {
	background: #000;
	background-size:contain;
	z-index: 100;
	max-height: 100%;
}

#canvaswrapper:active {
	cursor: pointer;	
}

#canvas:active {
	cursor: pointer;
}

#canvas svg:active {
	cursor: pointer;
}

#canvas svg {
	min-height: 100%;
	height: auto !important;
	height: 100%;
    width: 100%;
    margin: 0 auto;
    z-index: 1337;
}

#canvaswrapper {
	position: absolute;
	top: 0; 
	left: 10%;
	width: 90%;
	height: 100%;
	background: #111;	
	margin: 0 auto;
}

#canvascolours [data-colour] {
	width: 70px;
	height: 18px;
	cursor: pointer;
	border: 1px black solid;
	margin: 10px 20px;
}

#canvascolours {
	position: absolute;
	top: 350px;
	width: 100%;
	height: 300px;
	margin-top: 40px;
}

#feedback {
	height: 50px;
	background: #eee;
}

#save{
	cursor: pointer;
} 

#save:hover{
	background: #ff6100;
} 

#functions {
	position: absolute;
	top: 750px;
	left: 20px;
}

#undo, #redo {
	cursor: wait;
}

	</style>
</head>
<body>
	<div class="darken"></div>
	
	<div class="sidebar">
		
		<h1>Editor</h1>
			
		<ul>
			<li>Profile</li>
			<li>Editor</li>
			<li>Forum</li>
		</ul>

		
		<div id="maps">
			<div id="cs_assault" class="map">cs_assault</div>
			<div id="cs_italy" class="map">cs_italy</div>
			<div id="cs_office" class="map">cs_office</div>
			<div id="de_aztec" class="map">de_aztec</div>
			<div id="de_dust" class="map">de_dust</div>
			<div id="de_dust2" class="map">de_dust2</div>
			<div id="de_inferno" class="map">de_inferno</div>
			<div id="de_mirage" class="map">de_mirage</div>
			<div id="de_nuke" class="map">de_nuke</div>
			<div id="de_train" class="map">de_train</div>
			<div id="de_vertigo" class="map">de_vertigo</div>
		</div>
				
		<div id="canvascolours">
	        <div data-colour="black"></div>
	        <div data-colour="red"></div>
	        <div data-colour="orange"></div>
	        <div data-colour="yellow"></div>
	        <div data-colour="green"></div>
	        <div data-colour="blue"></div>
	        <div data-colour="cyan"></div>
	        <div data-colour="indigo"></div>
	        <div data-colour="violet"></div>
	        <div data-colour="grey"></div>
	        <div data-colour="white"></div>
	   </div>
	    <div id="functions">
	    <div id="clearbtn" >Clear All</div>

	    <div id="save">Save</div>
	    
	    <div id="undo" title="not yet functional">Undo</div>
	    
	    <div id="redo" title="not yet functional">Redo</div>
	    </div>

		
	</div>
	
	
	<div id="canvaswrapper">
    <div id="canvas"></div>
    <canvas id="canvas2"></canvas>
	<img id="converted_image" src="">
	</div> 

	
	
	<script>
	
		var canvas = document.getElementById('canvas'),
		sizeX = $(window).width(),
		sizeY = $(window).height(),
	    paper = new Raphael(canvas, sizeX, sizeY),
	    colour = 'white',
	    mousedown = false,
	    width = 4,
	    lastX, lastY, path, pathString;
		$('svg').attr("id","canvassvg");
	
		$(canvas).mousedown(function (e) {
		    mousedown = true;
		
		    var x = e.offsetX,
		        y = e.offsetY;
		
		    pathString = 'M' + x + ' ' + y + 'l0 0';
		    path = paper.path(pathString);
		    path.attr({
		        'stroke': colour,
		        'stroke-linecap': 'round',
		        'stroke-linejoin': 'round',
		        'stroke-width': width
		    });
		
		    lastX = x;
		    lastY = y;
		    
		
		 $("#clearbtn").mousedown(function() {
		     paper.clear();
		   });
		   







			
		 $("#undo").mousedown(function() {
		     paper.undo();
		   });

		 $("#redo").mousedown(function() {
		     paper.redo();
		   });


		});

		
		$(document).mouseup(function () {
		    mousedown = false;
		});
		
		$(canvas).mousemove(function (e) {
		    if (!mousedown) {
		        return;
		    }
		
		    var x = e.offsetX,
		        y = e.offsetY;
		
		    pathString += 'l' + (x - lastX) + ' ' + (y - lastY);
		    path.attr('path', pathString);
		
		    lastX = x;
		    lastY = y;
		});
		
		$(document).keydown(function (e) {
		    if (e.keyCode > 48 && e.keyCode < 58) {
		        width = e.keyCode - 48;
		    }
		});
				
		$('#canvascolours [data-colour]').each(function () {
			var $this = $(this),
	        divColour = $this.data('colour');

		    // Change the background colour of the box
		    $this.css('background-color', divColour);
		
		    // Add the event listener
		    $this.click(function () {
		        colour = divColour;
		    });
		});
		
		
		$( "#canvas" ).mousedown(function(event){
		    event.preventDefault();
		});
		
		
 ////////////////////////*ADD MAPS TO SVG*****////////////////////////////

		$("#cs_assault").mousedown(function() {
			//$("#canvassvg").css({'background' : 'url(bomb.gif) no-repeat center'}).css({'background-size' : 'contain'});
			paper.clear();
			var c = paper.image("images/cs_assault.png", 10, 10, 800, 800);

		});
		
		$("#cs_italy").mousedown(function() {
			//$("#canvassvg").css({'background' : 'url(bomb.gif) no-repeat center'}).css({'background-size' : 'contain'});
			paper.clear();
			var c = paper.image("images/cs_italy.png", 10, 10, 800, 800);

		});		
			
		$("#cs_office").mousedown(function() {
			//$("#canvassvg").css({'background' : 'url(bomb.gif) no-repeat center'}).css({'background-size' : 'contain'});
			paper.clear();
			var c = paper.image("images/cs_office.png", 10, 10, 800, 800);

		});
		
		$("#de_aztec").mousedown(function() {
			//$("#canvassvg").css({'background' : 'url(bomb.gif) no-repeat center'}).css({'background-size' : 'contain'});
			paper.clear();
			var c = paper.image("images/de_aztec.png", 10, 10, 800, 800);

		});		
			
		$("#de_dust").mousedown(function() {
			//$("#canvassvg").css({'background' : 'url(bomb.gif) no-repeat center'}).css({'background-size' : 'contain'});
			paper.clear();
			var c = paper.image("images/de_dust.png", 10, 10, 800, 800);

		});
		
		$("#de_dust2").mousedown(function() {
			//$("#canvassvg").css({'background' : 'url(bomb.gif) no-repeat center'}).css({'background-size' : 'contain'});
			paper.clear();
			var c = paper.image("images/de_dust2.png", 10, 10, 800, 800);

		});		
			
		$("#de_inferno").mousedown(function() {
			//$("#canvassvg").css({'background' : 'url(bomb.gif) no-repeat center'}).css({'background-size' : 'contain'});
			paper.clear();
			var c = paper.image("images/de_inferno.png", 10, 10, 800, 800);

		});
		
		$("#de_mirage").mousedown(function() {
			//$("#canvassvg").css({'background' : 'url(bomb.gif) no-repeat center'}).css({'background-size' : 'contain'});
			paper.clear();
			var c = paper.image("images/de_mirage.png", 10, 10, 800, 800);

		});		
			
		$("#de_nuke").mousedown(function() {
			//$("#canvassvg").css({'background' : 'url(bomb.gif) no-repeat center'}).css({'background-size' : 'contain'});
			paper.clear();
			var c = paper.image("images/de_nuke.png", 10, 10, 800, 800);

		});		
			
		$("#de_train").mousedown(function() {
			//$("#canvassvg").css({'background' : 'url(bomb.gif) no-repeat center'}).css({'background-size' : 'contain'});
			paper.clear();
			var c = paper.image("images/de_train.png", 10, 10, 800, 800);

		});		
			
		$("#de_vertigo").mousedown(function() {
			//$("#canvassvg").css({'background' : 'url(bomb.gif) no-repeat center'}).css({'background-size' : 'contain'});
			paper.clear();
			var c = paper.image("images/de_vertigo.png", 10, 10, 800, 800);

		});								
		
		
		
		
		
		
		
		
		
			$("#save").mousedown(function(){
				
			});
		$(document).ready(function(){
			
		$('canvas').css('height', 'sizeY');	
			
			
		});
		

	</script>
	
	<script>
	
	/*$('#save').click(function(){return document.location.href=_this.renderer.toDataURL('image/png').replace('image/png','image/octet-stream');});*/
		$('#save').mousedown(function(){
 
 
		   
		    var canvas = document.getElementById('canvas2');
		    var svg = document.getElementById('canvas');
	        svg = svg.innerHTML;
    		canvg(canvas, svg);
		    var img_url = canvas.toDataURL('image/png');
		    $('#converted_image').attr('src', img_url);
		    
			var img = canvas.toDataURL("image/png");
			
			document.write('<img src="'+img+'"/>');
			
		});
		
		
		
	</script>




</body>