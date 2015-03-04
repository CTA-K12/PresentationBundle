/**
 * jQuery Viewport Plugin
 *
 * similar to a css media query
 * returns height and width of client window (aka viewport)
 * in pixels
 *
 * @return {Object} | {int} | {int}
 */
(function ($) {
    var e = window;
    var a = 'inner';
    $.fn.viewport = function() {
        if (!('innerWidth' in window)) {
            a = 'client';
            e = document.documentElement || document.body;
        }
        return {width: e[a + 'Width'], height: e[a + 'Height']};
    };
    $.fn.viewportW = function() {
        if (!('innerWidth' in window)) {
            a = 'client';
            e = document.documentElement || document.body;
        }
        return e[a + 'Width'];
    };
    $.fn.viewportH = function() {
        if (!('innerWidth' in window)) {
            a = 'client';
            e = document.documentElement || document.body;
        }
        return e[a + 'Height'];
    };
}(jQuery));


// all links with hash tags are ignored
$(document).on('click', 'nav a[href="#"]', function(e) {
    e.preventDefault();
});

// set tooltips from bootstrap to all data-toggle=tooltip
$(function() {
    $('[data-toggle=tooltip]').tooltip();
});

// when sidebar is scrolled, set a cookie of the scroll position
$('#sidebar').scroll(function() {
    $.cookie('sscroll', $('#sidebar').scrollTop());
});

// when container-inner is scrolled, set a cookie of the scroll position
$('#container-inner').scroll(function() {
    $.cookie('cscroll', $('#container-inner').scrollTop());
});


// INITIALIZE LEFT NAV
$(document).ready(function() {
    if (!null) {
        $('aside#sidebar nav ul.nav').knpmenu({
            accordion :                                     true,
            speed :                                          200,
            closedSign : '<span class="fa fa-plus-square-o"></span>',
            openedSign : '<span class="fa fa-minus-square-o"></span>'
        });
    } else {
        alert("Error - menu anchor does not exist");
    }
});

/*
 * CUSTOM MENU PLUGIN
 */
$.fn.extend({

    //pass the options variable to the function
    knpmenu : function(options) {

        var defaults = {
            accordion : 'true',
            speed : 200,
            closedSign : '[+]',
            openedSign : '[-]'
        };

        // Extend our default options with those provided.
        var opts = $.extend(defaults, options);
        
        //Assign current element to variable, in this case is UL element
        var $this = $(this);

        //add a mark [+] to a multilevel menu
        $this.find("li").each(function() {
            if ($(this).find("ul").size() != 0) {
                //add the multilevel sign next to the link
                $(this).find("a:first").append("<span class='collapse-sign'>" + opts.closedSign + "</span>");

                //avoid jumping to the top of the page when the href is an #
                if ($(this).find("a:first").attr('href') == "#") {
                    $(this).find("a:first").click(function() {
                        return false;
                    });
                }
            }
        });

        //open active level
        $this.find("li.active").each(function() {
            $(this).parents("ul").slideDown(opts.speed);
            $(this).parents("ul").parent("li").find("b:first").html(opts.openedSign);
            $(this).parents("ul").parent("li").addClass("open")
        });

        $this.find("li a").click(function() {

            if ($(this).parent().find("ul").size() != 0) {

                if (opts.accordion) {
                    //Do nothing when the list is open
                    if (!$(this).parent().find("ul").is(':visible')) {
                        parents = $(this).parent().parents("ul");
                        visible = $this.find("ul:visible");
                        visible.each(function(visibleIndex) {
                            var close = true;
                            parents.each(function(parentIndex) {
                                if (parents[parentIndex] == visible[visibleIndex]) {
                                    close = false;
                                    return false;
                                }
                            });
                            if (close) {
                                if ($(this).parent().find("ul") != visible[visibleIndex]) {
                                    $(visible[visibleIndex]).slideUp(opts.speed, function() {
                                        $(this).parent("li").find("b:first").html(opts.closedSign);
                                        $(this).parent("li").removeClass("open");
                                    });

                                }
                            }
                        });
                    }
                }// end if
                if ($(this).parent().find("ul:first").is(":visible") && !$(this).parent().find("ul:first").hasClass("active")) {
                    $(this).parent().find("ul:first").slideUp(opts.speed, function() {
                        $(this).parent("li").removeClass("open");
                        $(this).parent("li").find("b:first").delay(opts.speed).html(opts.closedSign);
                    });

                } else {
                    $(this).parent().find("ul:first").slideDown(opts.speed, function() {
                        /*$(this).effect("highlight", {color : '#616161'}, 500); - disabled due to CPU clocking on phones*/
                        $(this).parent("li").addClass("open");
                        $(this).parent("li").find("b:first").delay(opts.speed).html(opts.openedSign);
                    });
                } // end else
            } // end if
        });
    } // end function
});
/* ~ END: CUSTOM MENU PLUGIN */

// COLLAPSE LEFT NAV
$('#sidebar-toggle').click(function(e) {
    $('#container-outer').toggleClass("minified");
    $(this).effect("highlight", {}, 500);
    e.preventDefault();
});


// Bootstrap Javascript
// ----------------------------------------------------------
// Refer to the following links for explanation:
// - http://getbootstrap.com/javascript/#callout-tooltip-groups
// - https://github.com/twbs/bootstrap/pull/5768
// The container `body` is not needed on `.btn` classed elements,
// but it looks nice; prevents the tooltip from falling behind the sidebar.
$('.btn-group [data-toggle="tooltip"], [data-toggle="tooltip"].btn').tooltip({
    container: 'body'
});