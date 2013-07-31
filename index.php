<!DOCTYPE HTML>
<head>
 	

 	<script src="js/jquery-2.0.1.min.js"></script>
 	<script src="raphael-min.js"></script>
	<script src="rgbcolor.js"></script>
	<script src="canvg.js"></script>
	<script src="StackBlur.js"></script>
	<script src="svg.min.js"></script>

 	<link href="style.css" rel="stylesheet" type="text/css">
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

	<div id="github">
		<a href="http://www.github.com/reactionmaster/tacmaster"><p>Please contribute on GitHub!</p></a>
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
	
		function getMousePos(canvas, evt) 
		{
			var rect = canvas.getBoundingClientRect();
			return {
			  x: evt.clientX - rect.left,
			  y: evt.clientY - rect.top
			};
		}
	
		$(canvas).mousedown(function (e) {
		    mousedown = true;
			
			var mousePos = getMousePos(canvas, e);
			
		    var x = mousePos.x,
		        y = mousePos.y;
		
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
		
		    var mousePos = getMousePos(canvas, e);
			
		    var x = mousePos.x,
		        y = mousePos.y;
				
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