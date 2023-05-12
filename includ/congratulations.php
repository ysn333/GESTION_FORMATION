    
<style>

@import url(https://fonts.googleapis.com/css?family=Sigmar+One);





.card  {
	width: 800px;
	height: 430px;
    background-image: url(assets/images/meetings-page-bg.jpg);
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	border-radius: 7px;
	box-shadow: 5px 10px 18px #000;
}

 .congrat {
    margin-top: 16pc;
    padding: 20px 10px;
    text-align: center;
  
}
.message-button {
	display: inline-block;
    padding: 10px 34px;
    background-color: #ffffff;
    color: black;
    text-decoration: none;
    border-radius: 6px;
    margin-top: 17pc;
    margin-bottom: 30px;
}




body {
    background-image: url(assets/images/meetings-page-bg.jpg);
    background-position: center center;
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;

}
h1 {
	transform-origin: 50% 50%;
	font-size: 50px;
	font-family: 'Sigmar One', cursive;
	cursor: pointer;
	z-index: 2;
	position: absolute;
	top: 5px;
	text-align: center;
	width: 100%;
}

.blob {
	height: 50px;
	width: 50px;
	color: #ffcc00;
	position: absolute;
	top: 45%;
	left: 45%;
	z-index: 1;
	font-size: 30px;
	display: none;	
}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https:/cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.2/underscore-min.js"></script>

<script>
// Click "Congratulations!" to play animation

$(function() {
	var numberOfStars = 20;
	
	for (var i = 0; i < numberOfStars; i++) {
	  $('.congrats').append('<div class="blob fa fa-star ' + i + '"></div>');
	}	

	animateText();
	
	animateBlobs();
});

$('.congrats').click(function() {
	reset();
	
	animateText();
	
	animateBlobs();
});

function reset() {
	$.each($('.blob'), function(i) {
		TweenMax.set($(this), { x: 0, y: 0, opacity: 1 });
	});
	
	TweenMax.set($('h1'), { scale: 1, opacity: 1, rotation: 0 });
}

function animateText() {
		TweenMax.from($('h1'), 0.8, {
		scale: 0.4,
		opacity: 0,
		rotation: 15,
		ease: Back.easeOut.config(4),
	});
}
	
function animateBlobs() {
	
	var xSeed = _.random(350, 380);
	var ySeed = _.random(120, 170);
	
	$.each($('.blob'), function(i) {
		var $blob = $(this);
		var speed = _.random(1, 5);
		var rotation = _.random(5, 100);
		var scale = _.random(0.8, 1.5);
		var x = _.random(-xSeed, xSeed);
		var y = _.random(-ySeed, ySeed);

		TweenMax.to($blob, speed, {
			x: x,
			y: y,
			ease: Power1.easeOut,
			opacity: 0,
			rotation: rotation,
			scale: scale,
			onStartParams: [$blob],
			onStart: function($element) {
				$element.css('display', 'block');
			},
			onCompleteParams: [$blob],
			onComplete: function($element) {
				$element.css('display', 'none');
			}
		});
	});
}
</script>