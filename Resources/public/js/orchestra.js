// TODO
// what is always-expandable
// and if it is what i think it is, why isn't it controlled by css?

// inhibits recurring callback for duration of quiet before executing
var delay = (function() {
    var timer = 0;
    return function(callback, ms){
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();

// viewport jQuery plugin
// like css media query, returns the height and width
// of the user's window (aka viewport)
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

// set tooltips from bootstrap to all data-toggle=tooltip
$(function() {
    $('[data-toggle=tooltip]').tooltip();
});

// when container-inner is scrolled, set a cookie of the scroll position
$('#container-inner').scroll(function() {
    $.cookie('cscroll', $('#container-inner').scrollTop());
});

$(document).ready(function() {
    // on page load, if container-inner cookie is scrolled, go back to position

    // if there is a div.alert ... then do not scroll
    // this may be modified by user settings
    // user settings not yet implemented
    // DL Sept 17, 2014

    if ($.cookie('cscroll') !== null && (0 === $('div.alert').length)) {
        $('#container-inner').scrollTop($.cookie('cscroll'));
    }

});