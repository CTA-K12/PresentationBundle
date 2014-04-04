var maximized  = 240;
var minimized  = 60;
var xsMin      = 0;
var smMin      = 768;
var mdMin      = 992;
var lgMin      = 1200;

// this sidebar object
function Sidebar() {
    // attributes
    this.max     = 240;
    this.min     =  60;
    this.currPos =   0;
    this.lastPos =   0;

    // methods
    this.getMin     = getMin;
    this.setMin     = setMin;
    this.getMax     = getMax;
    this.setMax     = setMin;
    this.getCurrPos = getCurrPos;
    this.setCurrPos = setCurrPos;
    this.getLastPos = getLastPos;
    this.setLastPos = setLastPos;
    this.isMinOrMax = isMinOrMax;

    // gets sidebar min
    function getMin()
    {
        return this.min;
    }

    // sets sidebar min
    function setMin(min)
    {
        this.min = min;
    }

    // gets sidebar max
    function getMax()
    {
        return this.max;
    }

    // sets sidebar max
    function setMax(max)
    {
        this.max = max;
    }

    // gets current position of sidebar
    function getCurrPos()
    {
        return this.currPos;
    }

    // sets current position of sidebar to pos
    function setCurrPos(pos)
    {
        this.currPos = pos;

        $('.sidebar').css('width', this.currPos);
        $('.content').css('margin-left', this.currPos);
        $('.drag-bar').css('left', this.currPos);
    }

    // gets last position of sidebar
    function getLastPos()
    {
        return this.lastPos;
    }

    // sets last position of sidebar to pos
    function setLastPos(pos)
    {
        this.lastPos = pos;
    }

    //returns 0 = min, -1 = between, 1 = max
    function isMinOrMax()
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

}

var sidebar = new Sidebar();
sidebar.setCurrPos(sidebar.getMax());

$('.drag-bar-handle').dblclick(function(e){
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


// when sidebar is scrolled, set a cookie of the scroll position
$('#sidebar').scroll(function() {
    $.cookie('sscroll', $('#sidebar').scrollTop());
});

// when content is scrolled, set a cookie of the scroll position
$('#content').scroll(function() {
    $.cookie('cscroll', $('#content').scrollTop());
});

$(document).ready(function() {

    $( "#tabs" ).tabs();

    // on page load, if sidebar cookie is scrolled, go back to position
    if ($.cookie('sscroll') !== null) {
        $('#sidebar').scrollTop($.cookie('sscroll'));
    }

    // on page load, if content cookie is scrolled, go back to position
    if ($.cookie('cscroll') !== null) {
        $('#content').scrollTop($.cookie('cscroll'));
    }

    // on page load, if sidebar cookie is collapsed, collapse sidebar
    if (($.cookie('sbar') !== null) && ($.cookie('sbar') === 'closed')) {
        $('.toggle-bar').toggleClass('toggle-bar-open toggle-bar-closed');
        $('.toggle-bar-handle').toggleClass('toggle-bar-handle-open toggle-bar-handle-closed');
        $('.toggle-bar-handle span').toggleClass('icon-chevron-left icon-chevron-right');
        $('.sidebar').toggleClass('sidebar-min');
        $('.sidebar .hideable').toggleClass('hide');
        $('.row-fluid-content').toggleClass('row-fluid-content-max');
    }

});