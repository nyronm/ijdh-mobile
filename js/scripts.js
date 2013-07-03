// Hide loop content when a diferent filter is selected
$(document).ready(function() {

    var popFiltered = '.popular_filtered'
    var recFiltered = '.recent_filtered'

    $(popFiltered).hide();
    $('.recent_filter').click(function() {
        $(popFiltered).hide();
        $(recFiltered).show();
    });
    $('.popular_filter').click(function() {
        $(recFiltered).hide();
        $(popFiltered).hide();
        $('#' + $(this).val()).show();
    });
    $('#popular_filter').change(function() {
        $(recFiltered).hide();
        $(popFiltered).hide();
        $('#' + $(this).val()).show();
    });
});

// Appends "..." to end of the last paragraph in the excerpt
$(document).ready(function() {
    $('#blog_roll .entry-content p:nth-last-of-type(1)').append('...');
});


// SLIDER
$(document).ready(function() {

    // If more than one slide then run slider
    if ($('#slider > div').length >= 2) {
        var slideContent = '#slider > div'
        var sliderPagination = '#slider_pagination'

        // Hide all other slides except for first one
        $(slideContent + ':gt(0)').hide();

        // Insert pagination for each image
        $(slideContent).each(function(i) {
            $(sliderPagination).append('<li class="but_'+(i+1)+'"><a href="#slide_content_'+(i+1)+'">'+(i+1)+'</a></li>');
        });

        // add Class to first slideContent on load
        $(slideContent + ':first').addClass('on');

        // slider function for autoSlider setInterval
        function slidesPlay () {
            $(slideContent + ':first')
            .fadeOut(1000)
            .removeClass('on')
            .next()
            .fadeIn(1000)
            .addClass("on")
            .end()
            .appendTo('#slider');
            }

        // Start autoSlider
        var autoSlider = setInterval(slidesPlay,  6000);

    ////////////////////////////////////////////////////////////////////////////////////////////////


        var slide = '#slide_content_'
        var button = sliderPagination + ' li.but_'

        // addClass to first button on load
        $(button + 1 + ' a').addClass('on');


        // Function for autoPagination setInterval. Checks if current slide hasClass 'on' and adds/removes class 'on' from corresponding pagination button.
        function paginationPlay () {

            if ($(slide + 1).hasClass('on')) {

                $(button + 1 + ' a').addClass('on');

            } else {
                    $(button + 1 + ' a').removeClass('on');
                }

            if ($(slide + 2).hasClass('on')) {

                $(button + 2 + ' a').addClass('on');

            } else {
                    $(button + 2 + ' a').removeClass('on');
                }

            if ($(slide + 3).hasClass('on')) {

                $(button + 3 + ' a').addClass('on');

            } else {
                    $(button + 3 + ' a').removeClass('on');
                };

        }

        // Start autoPagination setInterval
        autoPagination = setInterval(paginationPlay, 6000)

    ////////////////////////////////////////////////////////////////////////////////////////////////


        // Pause and Restart slider on Hover
        $("#slider_container").hover(function(){

            clearInterval(autoSlider);
            clearInterval(autoPagination);

        },function(){

            autoSlider = setInterval(slidesPlay,  6000);
            autoPagination = setInterval(paginationPlay,  6000);

        });

        // handle slider_pagination buttons on click
        $(sliderPagination + ' a').click(function(e) {

            //stop browser default
            e.preventDefault();

            //remove on states for all nav links
            $(sliderPagination + ' a').removeClass("on");

            //add on state to selected nav link
            $(this).addClass("on");

            // Target corresponding Slide and fadeIn, fadeOut the rest
            $(this.getAttribute('href'))
            .fadeIn(1000)
            .siblings()
            .fadeOut(1000)
            .end()
            .prependTo('#slider');
        });
    }


});// END OF SLIDER
/////////////////////////////////////////////////////////////////////
//////// 	REMOVE THE FACEBOOK AUTO STYLES ////////////////////////
/////////////////////////////////////////////////////////////////////
$(document).ready(function(){

	$("body.transparent_widget").css({backgroundColor: "#FFF"}); 
	
});