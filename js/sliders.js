/* Nivo Slider */
var j = jQuery.noConflict();
j(document).ready(function() {
	j('.slider').nivoSlider({
		effect:             'random',
		startSlide:         0, //Set starting Slide (0 index)
		animSpeed:          400, //Slide transition speed
		pauseTime:          3000,
		captionOpacity:     0.6, //Caption Opacity
		directionNav:       false, //Only show on hover
		pauseOnHover:       false, //Stop animation while hovering
		slices:             8, // For slice animations
        controlNav: false
	});
});
