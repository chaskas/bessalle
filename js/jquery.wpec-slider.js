(function ($) {
    $.fn.wpecSlider = function (options) {
        options = $.extend({}, $.fn.wpecSlider.options, options);

        var slider = $(this).find('ul');
        var window_focus = true;
        var quantity = slider.children().size();
        var next = 0, prev = 0, $next, $prev, current = options.current, pgNum = 0, position, slidePrev, slideNext, isPlaying = false, pgToOpen, playInterval, pauseTimeout;
        var width = slider.children().outerWidth();
        var stoped = false;
        
        if (options.directionalNav) {
            $(this).append('<a href="#" class="prev">prev</a><a href="#" class="next">next</a>');
            $next = $('.next', $(this));
            $prev = $('.prev', $(this));
            if (options.hiddenDirNav) {
                $next.hide();
                $prev.hide();
                $(this).mouseenter(function(){
                    $next.fadeIn(100);
                    $prev.fadeIn(100);
                });
                $(this).mouseleave(function(){
                    $next.stop().fadeOut(200);
                    $prev.stop().fadeOut(200);
                })
            }
        }
        function animate(direction, pgToOpen) {
            if (!isPlaying) {
                isPlaying = true;
                switch (direction) {
                    case 'next':
                        prev = current;
                        next = current + 1;
                        next = (quantity === next) ? 0 : next;
                        position = width;
                        direction = -width * 2;
                        current = next;
                        break;
                    case 'prev':
                        prev = current;
                        next = current - 1;
                        next = (next === -1) ? quantity - 1 : next;
                        position = -width;
                        direction = 0;
                        current = next;
                        break;
                    case 'pagination':
                        next = parseInt(pgToOpen,10);
                        prev = current;
                        if (next > prev) {
                            position = width*2;
                            direction = -width*2;
                        } else {
                            position = -width;
                            direction = 0;
                        }
                        // store new current slide
                        current = next;
                        break;
                }

                slidePrev = slider.children(':eq(' + prev + ')');
                slideNext = slider.children(':eq(' + next + ')');

                slider.children().css({
                    zIndex:0
                });
                slidePrev.css({
                    zIndex:1
                });

                onSlideStart(slidePrev, slideNext);

                slideNext.css({
                    zIndex:2,
                    left:position
                }).animate({
                        left:0
                    }, options.animationSpeed, 'easeInOutExpo', function () {
                        isPlaying = false;
                        onSlideComplete($(this))
                    });
            }

            // set current state for pagination
            if (options.pagination) {
                // remove current class from all
                $('.'+ options.paginationClass +' li.curr', slider.parent()).removeClass('curr');
                // add current class to next
                $('.' + options.paginationClass + ' li:eq('+ next +')', slider.parent()).addClass('curr');
            }
        }
        
       
        
        $next.click(function (e) {
            e.preventDefault();
            if (options.autoplay) {
                pause();
            }
            animate('next');
        });

        $prev.click(function (e) {
            e.preventDefault();
            if (options.autoplay) {
                pause();
            }
            animate('prev');
        });

        // pagination
        if (options.pagination) {
                slider.parent().append('<ol class='+ options.paginationClass +'></ol>');
            // for each slide create a list item and link
            slider.children().each(function(){
                $('.' + options.paginationClass, slider.parent()).append('<li><a href="#'+ pgNum +'">'+ (pgNum) +'</a></li>');
                pgNum++;
            });
        }

        $('.' + options.paginationClass + ' li a', slider.parent()).click(function(){
            if(!$(this).parent().hasClass('curr')){
                // pause slideshow
                if (options.play) {
                    pause();
                }
                // get pgToOpen, pass to animate function
                pgToOpen = $(this).attr('href').match('[^#/]+$');
                // if current slide equals pgToOpen, don't do anything
                if (current != pgToOpen) {
                    animate('pagination', pgToOpen);
                }
            }
            return false;
        });

        if (options.autoplay) {
            // set interval
            playInterval = setInterval(function() {
                animate('next');
            }, options.autoplay);
            // store interval id
            slider.data('interval',playInterval);
        }

        function pause() {
            if (options.pause) {
                // clear timeout and interval
                clearTimeout(slider.data('pause'));
                clearInterval(slider.data('interval'));
                // pause slide show for options.pause amount
                pauseTimeout = setTimeout(function() {
                    // clear pause timeout
                    clearTimeout(slider.data('pause'));
                    // start play interval after pause
                    playInterval = setInterval(	function(){
                        animate("next");
                    },options.autoplay);
                    // store play interval
                    slider.data('interval',playInterval);
                },options.pause);
                // store pause interval
                slider.data('pause',pauseTimeout);
            } else {
                // if no pause, just stop
                stop();
            }
        }

        function stop() {
            // clear interval from stored id
            clearInterval(slider.data('interval'));
        }

        // pause on mouseover
        if (options.pauseOnHover && options.autoplay) {
            slider.parent().bind('mouseover',function(){
                // on mouse over stop
                stop();
            });
            slider.parent().bind('mouseleave',function(){
                pause();
            });
        }
        
        $(window).bind('blur', function(){
	       window_focus = false;
	    });
	
	    $(window).bind('focus', function(){
	        window_focus = true;
	        if (options.autoplay) {
	        
		        if (stoped) {
			        pause();
		        }
	        
	        }
	       
	    });
	    // IE EVENTS
	    $(document).bind('focusout', function(){
	        window_focus = false;
	    });
	
	    $(document).bind('focusin', function(){
	       window_focus = true;
	       
	       if (options.autoplay) {
		         if (stoped) {
			        pause();
		        }
	        
	        }
	    });
	    
	    // handlers
        function onSlideStart(prev, next) {
	        
            prev.find('.about').animate({opacity:0}, 500, 'easeOutSine');
            $(prev.find('.about > *').get().reverse()).each(function (i) {
                $(this).delay(i * 60 + 20).animate({top:300}, 400, 'easeInSine');
            });
            prev.find('.product-image').delay(300).animate({transform:'scale(.2)', opacity:0}, 450, 'easeOutSine', function(){ prev.css('visibility','hidden')});
            
            next.css('visibility', 'visible');
            next.find('.about').animate({opacity:1}, 500, 'easeInSine');
            $(next.find('.about > *').get().reverse()).each(function (i) {
                $(this).css({top:-300}).delay(i * 60+200).animate({top:0}, 400, 'easeInSine');
            });
            next.find('.product-image').css({transform:'scale(.2)'}).delay(150).animate({transform:'scale(1)', opacity:1}, 450, 'easeInSine', function(){$(this).css({transform:'none'})});
        }

        function onSlideComplete(prev, next) {
	    	if (options.autoplay) { if (!window_focus) { stop(); stoped = true; } }
	    }


    };

    $.fn.wpecSlider.options = {
        directionalNav: true,
        hiddenDirNav: false,
        pagination: true,
        paginationClass: 'pagination',
        autoplay: 3000,
        pause: 100,
        animationSpeed: 550,
        pauseOnHover: true,
        current: 0
    }
})(jQuery);