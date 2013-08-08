var canvas = document.getElementById('canvas'),
    sizeX = 914, // Max minimap size
    sizeY = 914, // Maz minimap size
    paper = new Raphael(canvas, sizeX, sizeY),
    colour = 'white',
    mousedown = false,
    width = 4,
    lastX,
    lastY,
    path,
    pathString,
    imageFolder = '/tacmaster/images/';

$('svg').attr("id","canvassvg");

function getMousePos(canvas, evt)
{
    var rect = canvas.getBoundingClientRect(),
        canvasPos = $('#canvassvg').offset()['left']; // fix the centered canvas
    return {
        x: evt.clientX - rect.left - canvasPos,
        y: evt.clientY - rect.top
    };
}

$(canvas).on('mousedown',function (e) {
    mousedown = true;

    var mousePos = getMousePos(canvas, e),
        x = mousePos.x,
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

    $("#clearbtn").on('mousedown',function() {
        paper.clear();
    });

    $("#undo").on('mousedown',function() {
        paper.undo();
    });

    $("#redo").on('mousedown',function() {
        paper.redo();
    });

});


$(document).on('mouseup',function () {
    mousedown = false;
});

$(canvas).on('mousemove',function (e) {
    if (!mousedown) {
        return;
    }

    var mousePos = getMousePos(canvas, e),
        x = mousePos.x,
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


$( "#canvas" ).on('mousedown',function(event){
    event.preventDefault();
});


////////////////////////*ADD MAPS TO SVG*****////////////////////////////

$('.map').on('mousedown', function() {
    //$("#canvassvg").css({'background' : 'url(bomb.gif) no-repeat center'}).css({'background-size' : 'contain'});
    paper.clear();
    var c = paper.image(imageFolder+$(this).data('map')+'.png', 10, 10, 800, 800);
});

$(document).ready(function(){
    $('canvas').css('height', 'sizeY');
});


/** TO DO **/
/*
$('#save').on('mousedown',function(){
    var canvas = document.getElementById('canvas2'),
        svg = document.getElementById('canvas').innerHTML,
        img_url = canvas.toDataURL('image/png'),
        img = canvas.toDataURL("image/png");

    canvg(canvas, svg);
    $('#converted_image').attr('src', img_url);
    document.write('<img src="'+img+'"/>');

});
*/

/*  function saveDaPicture(){
var img = document.getElementById('canvas').toDataURL("image/png");
$('body').append('<img src="'+img+'"/>');
}

$('#save').click(function(){
var svg = $('#canvaswrapper').html().replace(/>\s+/g, ">").replace(/\s+</g, "<");
                         // strips off all spaces between tags
//alert(svg);
canvg('canvas', svg, {renderCallback: saveDaPicture, ignoreMouse: true, ignoreAnimation: true});
});
*/

/*$('#save').click(function(){return document.location.href=_this.renderer.toDataURL('image/png').replace('image/png','image/octet-stream');});*/
