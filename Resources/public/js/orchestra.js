//inhibits recurring callback for duration of quiet before executing

var delay = (function(){
    var timer = 0;
    return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
    };
})();

// this sidebar object
var sidebar = new function () {
    // attributes; raw vlaues are currently
    // in Resources/views/Block/settings.js.twig

    this.max      =  maximized;
    this.min      =  minimized;

    // if doubt, default 60
    this.currPos  =  60       ;
    this.lastPos  =  60       ;


    this.timer    =  null     ;

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
    this.isMin = function()
    {
        return this.currPos <= this.min;
    }

    //returns 0 = min, -1 = between, 1 = max
    this.isMax = function()
    {
        return this.currPos >= this.max;
    }


    this.relabel = function(){

        var vp = $(window).viewportW();
        var cp = this.getCurrPos();
        var th = threshold * this.max;

        if ( vp < mdMin ) {

            // always hide labels at table size
            this.hidelabel();

        } else if (this.getCurrPos() < threshold * this.max ) {
            this.hidelabel();
        } else {
            this.showlabel();
        }

        if ( this.getCurrPos() == this.min ) {
            $('.sidebar').addClass('sidebar-closed');
            $('.sidebar').removeClass('sidebar-open');
        } else {
            $('.sidebar').removeClass('sidebar-closed');
            $('.sidebar').addClass('sidebar-open');
        }
    }

    this.showlabel = function(){
        $('.sidebar').find('.hideable').removeClass('hide');
        $.removeCookie('MesdPresentationHideSidebarLabels', { path: '/', expires: 30 });
    }

    this.hidelabel = function(){
        $('.sidebar').find('.hideable').addClass('hide');
        $.cookie('MesdPresentationHideSidebarLabels', 1, { path: '/', expires: 30 });
    }

    this.close = function() {
        $.cookie('MesdPresentationSidebarClosed', 1, { path: '/', expires: 30 });
    }

    this.open = function() {
        // $.removeCookie('MesdPresentationSidebarClosed');
        $.cookie('MesdPresentationSidebarClosed', 0, { path: '/', expires: 30 });
    }

    // remove labels if sidebar closed
    this.finishMove = function() {
        this.relabel();
        $.cookie('MesdPresentationSidebarSize', this.getCurrPos(), { path: '/', expires: 30 });
    }
}


$('.drag-bar-handle').dblclick(function(e){
    e.preventDefault();

    var vp = $(window).viewportW();
    if ( vp >= mdMin ) {

        $('.sidebar').find('.hideable').toggleClass('hide');
        if (e.pageX) {
            var xcoord = e.pageX;

            if(sidebar.max >= e.pageX - 6 && sidebar.max <= e.pageX + 6){
                xcoord = sidebar.min;
            }
            else if(sidebar.min <= e.pageX + 6 && sidebar.min >= e.pageX - 6){
                xcoord = sidebar.max;
            }
            else if(sidebar.max > e.pageX - 1){
                xcoord = sidebar.min;
            }
            else{
                xcoord = sidebar.max;
            }

            sidebar.setLastPos(xcoord);
            sidebar.setCurrPos(xcoord);

            if (sidebar.min == xcoord) {
                sidebar.close();
            } else {
                sidebar.open();
            }

        } else {
            if ($('.sidebar').hasClass('sidebar-closed')) {
                sidebar.open();
                sidebar.setLastPos(240);
                sidebar.setCurrPos(240);
            } else {
                sidebar.close();
                sidebar.setLastPos(60);
                sidebar.setCurrPos(60);
            }
        }
    }

    sidebar.finishMove();
});


$('.drag-bar').mousedown(function(e){
    e.preventDefault();
    var vp = $(window).viewportW();
    if ( vp >= mdMin ) {
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
            if (xcoord < sidebar.min) {
                xcoord = sidebar.min;
            }
            sidebar.setCurrPos(xcoord);
            sidebar.setLastPos(xcoord);
            sidebar.finishMove();
        });
    } else {
        // don't open
    }
});


$(document).mouseup(function(e){
    var vp = $(window).viewportW();
    if ( vp < mdMin ) {
        sidebar.setLastPos(sidebar.getCurrPos());
    } else {
        // don't open
    }
    $(document).unbind('mousemove');
});

$(window).resize(function(){
    var vp = $(window).viewportW();

    if(vp <= sidebar.getCurrPos()) {

            // if size is smaller than minimum,
            // resize sidebar to current size

            sidebar.setCurrPos(vp);
            sidebar.setLastPos(vp);

        } else if(vp < mdMin) {


            // if tablet size or smaller, close sidebar
            // and remember last position

            if ( sidebar.isMin() ) {
            } else if ( sidebar.isMax() ) {
                // sidebar.setLastPos(sidebar.getMax());
                sidebar.setLastPos(240);
            } else {
                sidebar.setLastPos(sidebar.getCurrPos());
            }
            sidebar.setCurrPos(sidebar.getMin());

        // }   else if(1 == sidebar.isMin) {

            // if we are at minimum already
            // and size is tablet or greater,
            // do nothing

        // }   else if (1 == sidebar.isMax ) {

            // if we are at maximum already
            // and size is tablet or greater,
            // do nothing

        } else {
            sidebar.setCurrPos(sidebar.getLastPos());
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

    if ($.cookie('MesdPresentationSidebarSize') <= 0 ) {
        $.cookie('MesdPresentationSidebarSize', 240, { path: '/', expires: 30  });
        $.removeCookie('MesdPresentationHideSidebarLabels', { path: '/' });
        sidebar.setCurrPos(240);
        sidebar.finishMove();
        sidebar.open();
    } else {
    }

    if ($.cookie('MesdPresentationSidebarSize') <= 60 ) {
        $.cookie('MesdPresentationSidebarSize', 60, { path: '/', expires: 30 });
        sidebar.setCurrPos(60);
        sidebar.finishMove();
        sidebar.close();
    } else {
        sidebar.open();
    }

    // fix up some odd issues if they login without a cookie.
});