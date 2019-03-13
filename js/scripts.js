$(function(){   
    var $cat = $("#department"),
    $subcat = $(".subcat");
    
    var optgroups = {};    
    $subcat.each(function(i,v){
        var $e = $(v);
    	var _id = $e.attr("id");
		optgroups[_id] = {};
		$e.find("optgroup").each(function(){
      	    var _r = $(this).data("rel");
            $(this).find("option").addClass("is-dyn");
      	    optgroups[_id][_r] = $(this).html();
		});
    });
    $subcat.find("optgroup").remove();
    
    var _lastRel;
    $cat.on("change",function(){
        var _rel = $(this).val();
        if(_lastRel === _rel) return true;
        _lastRel = _rel;
        $subcat.find("option").attr("style","");
        $subcat.val("");
        $subcat.find(".is-dyn").remove();
        if(!_rel) return $subcat.prop("disabled",true);
        $subcat.each(function(){
        	var $el = $(this);
            var _id = $el.attr("id");
            $el.append(optgroups[_id][_rel]);
        });
        $subcat.prop("disabled",false);
    });    
});

/*$( document ).ready(function() {
	$("select#department option").filter(function() {
		$meVal = '<?php echo $userdetailmessage['department']; ?>';
		return $(this).val() == $meVal;
	}).prop('selected', true);
});*/

// SEARCH mygtuko aktyvavimas
function enableSearchButton() {
	if(document.getElementById("search").value==="") { 
		document.getElementById('searchButton').disabled = true; 
    } else { 
		document.getElementById('searchButton').disabled = false;
    }
}

(function($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle").on('click',function(e) {
    e.preventDefault();
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll',function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(event) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    event.preventDefault();
  });

})(jQuery); // End of use strict


$(function(){
    $(".displayed").on({
        mouseenter: function(){
            $(this).attr('src','images/gear.gif');
        },
        mouseleave: function(){
            $(this).attr('src','images/gear.jpg');
        }
    });

});
