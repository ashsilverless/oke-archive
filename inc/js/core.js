//@prepros-prepend jquery.magnific-popup.js
//@prepros-prepend owl.carousel.min.js
//@prepros-prepend mixitup.js
jQuery(document).ready(function( $ ) {

/* ADD CLASS ON LOAD*/

    $("html").delay(1500).queue(function(next) {
        $(this).addClass("loaded");
        next();
    });

//Smooth Scroll

    $('nav a, a.button, a.next-section, a.explore').click(function(){
	    if($(this).attr('href') != "#") {
	        $('html, body').animate({
	            scrollTop: $( $(this).attr('href') ).offset().top -100
	        }, 500);
	        return false;
	    }
    });

/* ADD CLASS ON SCROLL*/

	$(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 100) {
            $("body").addClass("scrolled");
        } else {
            $("body").removeClass("scrolled");
        }
    });

// ========== Controller for lightbox elements

	$(".gallery").each(function() {
		$(this).find(".lightbox-gallery").magnificPopup({
	        type: 'image',
	        gallery:{
	            enabled:true
	        }
	    });
	});

    $('.single-image').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		fixedContentPos: true,
		mainClass: 'mfp-no-margins mfp-with-zoom',
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300
		}
	});

	$('.post-image a').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		fixedContentPos: true,
		mainClass: 'mfp-no-margins mfp-with-zoom',
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300
		}
	});

// GLOBAL OWL CAROUSEL SETTINGS

/* CLASS AND FOCUS ON CLICK */

    $(".menu-trigger").click(function() {
	    $(".menu-collapse").toggleClass("visible");
	    $(".current-menu-item").toggleClass("loaded");
	    $(".menu-trigger").toggleClass("opened");
    });

    $(".read-more").click(function() {
	    $(this).prev().slideToggle();
	    $(this).text($(this).text() == "Read more" ? "Read less" : "Read more");
    });

    $(".tab-trigger").click(function() {
	    $(".tab-trigger.active").removeClass("active");
	    $(this).addClass('active');
    });

    $(".see-more").click(function() {
	    $(this).closest('.camp-summary__item').toggleClass("open");
    });

    $(".safari-itinerary__item p.heading").click(function() {
        $(".safari-itinerary__item.open").removeClass("open");
	    $(this).closest('.safari-itinerary__item').toggleClass("open");
    });
    $(".safari-itinerary__item:first-child").addClass("open");

    $('.checkbox input:checkbox').click(function(){
        if($('input[value="' + this.value + '"]:checkbox').prop('checked', this.checked)) {
            $('button.filter-reset').addClass("visible");
            $('div.filtered-result').addClass("visible");
            $('div.filter-header').addClass("filter-active");
        }
    });

    $('.checkbox input:checkbox').click(function(){
        var textinputs = document.querySelectorAll('.checkbox input[type=checkbox]');
        var empty = [].filter.call( textinputs, function( el ) {
           return !el.checked
        });
        if (textinputs.length == empty.length) {
            $('button.filter-reset').removeClass("visible");
            $('div.filtered-result').removeClass("visible");
            $('div.filter-header').removeClass("filter-active");
        }
    });

    $('input[type="checkbox"]').click(function() {
      $('input[value="' + this.value + '"]:checkbox').prop('checked', this.checked)
      });

// ========== Count filter results
/*
$('.checkbox input:checkbox').click(function() {
    var isvis = $('div.mix').css('display');
    if($(isvis)) {
        console.log('yep');
        $(this).addClass('aaaa');
    } else {
        //$('div.mix').removeClass("ewrewrwerewr");
    }
});*/

/*$('.checkbox input:checkbox').click(function() {
    $('div.mix').addClass(function(){
            var floated = $(this).css('display');
            return floated ? 'display-' + floated : '';
        });
        var n = $('div.mix.display-block').length;
        $( "span#filter-count" ).text(n);
});*/

// ========== Add class if in viewport on page load

	$.fn.isOnScreen = function(){

	    var win = $(window);

	    var viewport = {
	        top : win.scrollTop(),
	        left : win.scrollLeft()
	    };
	    viewport.right = viewport.left + win.width();
	    viewport.bottom = viewport.top + win.height();

	    var bounds = this.offset();
	    bounds.right = bounds.left + this.outerWidth();
	    bounds.bottom = bounds.top + this.outerHeight();

	    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));

	};

	$('.slide-up, .slide-down, .slide-right, .slow-fade').each(function() {
		if ($(this).isOnScreen()) {
			$(this).addClass('active');
		}
	});

// ========== Add class on entering viewport

	$.fn.isInViewport = function() {
	var elementTop = $(this).offset().top;
	var elementBottom = elementTop + $(this).outerHeight();
	var viewportTop = $(window).scrollTop();
	var viewportBottom = viewportTop + $(window).height();
	return elementBottom > viewportTop && elementTop < viewportBottom;
	};

	$(window).on('resize scroll', function() {

		$('.slide-up, .slide-down, .slide-right, .slow-fade').each(function() {
			if ($(this).isInViewport()) {
				$(this).addClass('active');
			}
		});

	});

// ========== Tab Slider

var action = false, clicked = false;
var Owl = {
    init: function() {
      Owl.carousel();
    },
	carousel: function() {
		var owl;
		$(document).ready(function() {
			owl = $('.tabs').owlCarousel({
				items 	 : 1,
				center	   : true,
				nav        : false,
				dots       : true,
				loop       : true,
				margin     : 10,
				dotsContainer: '.test',
				navText: ['prev','next'],
			});
			  $('.owl-next').on('click',function(){
			  	action = 'next';
			  });
			  $('.owl-prev').on('click',function(){
			  	action = 'prev';
			  });
			 $('.tabs-header').on('click', 'li', function(e) {
			    owl.trigger('to.owl.carousel', [$(this).index(), 300]);
			  });
		});
	}
};
$(document).ready(function() {
  Owl.init();
});

/***********HERO SLIDER***********/
var slideCount = $('#slider ul li').length;
var slideWidth = $('#slider ul li').width();
var slideHeight = $('#slider ul li').height();
var sliderUlWidth = slideCount * slideWidth;
$('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
$('#slider ul li:last-child').prependTo('#slider ul');
function moveLeft() {
    $('#slider ul').animate({
        left: + slideWidth
    }, 500, function () {
        $('#slider ul li:last-child').prependTo('#slider ul');
        $('#slider ul').css('left', '');
    });
};
function moveRight() {
    $('#slider ul').animate({
        left: - slideWidth
    }, 500, function () {
        $('#slider ul li:first-child').appendTo('#slider ul');
        $('#slider ul').css('left', '');
    });
};
$('a.control_prev').click(function () {
    moveLeft();
});
$('a.control_next').click(function () {
    moveRight();
});

/*********** FILTER CONTROLLER ***********/

var multiFilter = {
  // Declare any variables we will need as properties of the object
  $filterGroups: null,
  $filterUi: null,
  $reset: null,
  groups: [],
  outputArray: [],
  outputString: '',
  // The "init" method will run on document ready and cache any jQuery objects we will need.
  init: function(){
    var self = this; // As a best practice, in each method we will asign "this" to the variable "self" so that it remains scope-agnostic. We will use it to refer to the parent "checkboxFilter" object so that we can share methods and properties between all parts of the object.
    self.$filterUi = $('#Filters');
    self.$filterGroups = $('.filter-group');
    self.$reset = $('#reset');
    self.$container = $('#Container');
    self.$filterGroups.each(function(){
      self.groups.push({
        $inputs: $(this).find('input'),
        active: [],
		    tracker: false
      });
    });
    self.bindHandlers();
  },
  // The "bindHandlers" method will listen for whenever a form value changes.
  bindHandlers: function(){
    var self = this,
        typingDelay = 300,
        typingTimeout = -1,
        resetTimer = function() {
          clearTimeout(typingTimeout);

          typingTimeout = setTimeout(function() {
            self.parseFilters();
          }, typingDelay);
        };
    self.$filterGroups
      .filter('.checkboxes')
    	.on('change', function() {
      	self.parseFilters();
    	});
    self.$filterGroups
      .filter('.search')
      .on('keyup change', resetTimer);
    self.$reset.on('click', function(e){
      e.preventDefault();
      self.$filterUi[0].reset();
      self.$filterUi.find('input[type="text"]').val('');
      self.parseFilters();
    });
  },
  // The parseFilters method checks which filters are active in each group:
  parseFilters: function(){
    var self = this;
    // loop through each filter group and add active filters to arrays
    for(var i = 0, group; group = self.groups[i]; i++){
      group.active = []; // reset arrays
      group.$inputs.each(function(){
        var searchTerm = '',
       			$input = $(this),
            minimumLength = 3;
        if ($input.is(':checked')) {
          group.active.push(this.value);
        }
        if ($input.is('[type="text"]') && this.value.length >= minimumLength) {
          searchTerm = this.value
            .trim()
            .toLowerCase()
            .replace(' ', '-');
          group.active[0] = '[class*="' + searchTerm + '"]';
        }
      });
	    group.active.length && (group.tracker = 0);
    }
    self.concatenate();
  },
  // The "concatenate" method will crawl through each group, concatenating filters as desired:
  concatenate: function(){
    var self = this,
		  cache = '',
		  crawled = false,
		  checkTrackers = function(){
        var done = 0;
        for(var i = 0, group; group = self.groups[i]; i++){
          (group.tracker === false) && done++;
        }
        return (done < self.groups.length);
      },
      crawl = function(){
        for(var i = 0, group; group = self.groups[i]; i++){
          group.active[group.tracker] && (cache += group.active[group.tracker]);
          if(i === self.groups.length - 1){
            self.outputArray.push(cache);
            cache = '';
            updateTrackers();
          }
        }
      },
      updateTrackers = function(){
        for(var i = self.groups.length - 1; i > -1; i--){
          var group = self.groups[i];
          if(group.active[group.tracker + 1]){
            group.tracker++;
            break;
          } else if(i > 0){
            group.tracker && (group.tracker = 0);
          } else {
            crawled = true;
          }
        }
      };
    self.outputArray = []; // reset output array
	  do{
		  crawl();
	  }
	  while(!crawled && checkTrackers());
    self.outputString = self.outputArray.join();
    // If the output string is empty, show all rather than none:
    !self.outputString.length && (self.outputString = 'all');
    console.log(self.outputString);
    // ^ we can check the console here to take a look at the filter string that is produced
    // Send the output string to MixItUp via the 'filter' method:
	  if(self.$container.mixItUp('isLoaded')){
    	self.$container.mixItUp('filter', self.outputString);
	  }
  }
};
// On document ready, initialise our code.
$(function(){
  // Initialize multiFilter code
  multiFilter.init();
  // Instantiate MixItUp
  $('#Container').mixItUp({
    controls: {
      enable: false // we won't be needing these
    },
    animation: {
      easing: 'cubic-bezier(0.86, 0, 0.87, 1)',
      queueLimit: 3,
      duration: 500
    }
  });
});

});//Don't remove ---- end of jQuery wrapper
