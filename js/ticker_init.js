(function($){
	$(document).ready(function(){
		$('.ent_ticker').easyTicker({
			direction: 'up',
			easing: 'swing',
			speed: 'slow',
			interval: 2000,
			height: 'auto',
			visible: 0,
			mousePause: 1,
			controls: {
				up: '',
				down: '',
				toggle: '',
				playText: 'Play',
				stopText: 'Stop'
			}
		});
	});
})(jQuery);
