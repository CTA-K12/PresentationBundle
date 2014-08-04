var delay = (function(){
    var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
    };
})();

// this sidebar object
var sidebar = new function () {
    // attributes
    this.max     =  240;
    this.min     =   60;
    this.currPos =    0;
    this.lastPos =    0;
    this.timer   = null;

    // gets sidebar min
    this.getMin = function()
    {
        return this.min;
    }

    // sets sidebar min
    this.setMin = function(setMin)
    {
        this.min = min;
    }

    // gets sidebar max
    function getMax()
    {
        return this.max;
    }

    // sets sidebar max
    this.setMax = function(setMax)
    {
        this.max = max;
    }

    // gets current position of sidebar
    this.getCurrPos = function()
    {
        return this.currPos;
    }

    // sets current position of sidebar to pos
    this.setCurrPos = function(pos)
    {
        this.currPos = pos;

        $('.sidebarOuter').css('width', this.currPos);
        $('.sidebar').css('width', this.currPos);
        $('.container-inner').css('margin-left', this.currPos);
        $('.drag-bar').css('left', this.currPos);
    }

    // gets last position of sidebar
    this.getLastPos = function()
    {
        return this.lastPos;
    }

    // sets last position of sidebar to pos
    this.setLastPos = function(pos)
    {
        this.lastPos = pos;
    }

    //returns 0 = min, -1 = between, 1 = max
    this.isMinOrMax = function()
    {
        var currentPos = this.currPos;

        if(currentPos >= this.max) {
            // is current position at or greater than maximum sidebar?
            return 1;
        } else if(currentPos > this.min) {
            // is current position greater than minimum sidebar,
            // but smaller than maximum sidebar?
            return -1;
        } else {
            // if no on both, than it's smaller or equal to
            // the minimum sidar
            return 0;
        }
    }

    this.relabel = function(){
        if (this.getCurrPos() > threshold * maximized) {
            $('.sidebar').find('.hideable').removeClass('hide');
            $.removeCookie('MesdPresentationHideSidebarLabels', { path: '/' });
         } else {
            $('.sidebar').find('.hideable').addClass('hide');
            $.cookie('MesdPresentationHideSidebarLabels', 1, { path: '/' });
        }
    }

    // remove labels if sidebar closed
    this.finishMove = function() {
        this.relabel();
        $.cookie('MesdPresentationSidebarSize', this.getCurrPos(), { path: '/' });
    }
}



$('.drag-bar-handle').dblclick(function(e){
    $('.sidebar').find('.hideable').toggleClass('hide');
    e.preventDefault();
    var xcoord = e.pageX;
    if(maximized >= e.pageX - 6 && maximized <= e.pageX + 6){
        xcoord = minimized;
    }
    else if(minimized <= e.pageX + 6 && minimized >= e.pageX - 6){
        xcoord = maximized;
    }
    else if(maximized > e.pageX - 1){
        xcoord = minimized;
    }
    else{
        xcoord = maximized;
    }
    sidebar.setLastPos(xcoord);
    sidebar.setCurrPos(xcoord);
    sidebar.finishMove();
});


$('.drag-bar').mousedown(function(e){
    e.preventDefault();
    $(document).mousemove(function(e){
        var xcoord = e.pageX - 1;
        if(0 >= e.pageX - 1){
            xcoord = 0;
        }
        else if($(window).viewportW() - 2 <= e.pageX){
            xcoord = $(window).viewportW() - 2;
        }
        else{
            xccord = e.pageX - 1;
        }
        sidebar.setCurrPos(xcoord);
        sidebar.finishMove();
        delay(function(){ sidebar.finishMove();}, quiet)
    });
});


$(document).mouseup(function(e){
    sidebar.setLastPos(sidebar.getCurrPos());
    $(document).unbind('mousemove');
});

$(window).resize(function(){
    var vp = $(window).viewportW();
    // if viewport < breakpoint && c sidebar == max
    //    set last position = current position
    //    set current position = minimum position
    if((vp < mdMin) && (sidebar.getMin() < sidebar.getCurrPos())) {
        sidebar.setLastPos(sidebar.getCurrPos());
        sidebar.setCurrPos(sidebar.getMin());
    }
    // if viewport >= breakpoint && c sidebar != max and p sidebar == max
    //    set current position = last postion
    //    set last position = minimum position
    else if((vp >= mdMin) && (1 != sidebar.isMinOrMax()) && (sidebar.getMin() < sidebar.getLastPos())) {
        sidebar.setCurrPos(sidebar.getLastPos());
        sidebar.setLastPos(sidebar.getMin());
    }
    // if viewport >= breakpoint && c sidebar == max
    //    do nothing
    else if((vp > mdMin) && (sidebar.getLastPos() <= sidebar.getMin())) {
        // do nothing
    }
    else if(vp <= sidebar.getCurrPos()) {
        sidebar.setCurrPos(vp);
        sidebar.setLastPos(vp);
    }
    sidebar.finishMove();
});

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
}( jQuery ));

$(function () {
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

$(document).ready(function() {
    $( "#tabs" ).tabs();

    // on page load, if sidebar cookie is scrolled, go back to position
    if ($.cookie('sscroll') !== null) {
        $('#sidebar').scrollTop($.cookie('sscroll'));
    }

    // on page load, if container-inner cookie is scrolled, go back to position
    if ($.cookie('cscroll') !== null) {
        $('#container-inner').scrollTop($.cookie('cscroll'));
    }

    // fix up some odd issues if they login without a cookie.
});