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

var sidebar_size = 240;
var small_screen = 991;

var clicking = false;
// this sidebar object
var sidebar = new function() {
    // attributes; raw vlaues are currently
    // in Resources/views/Block/settings.js.twig
    this.max        = maximized;
    this.min        = minimized;
    this.currPos    = 60;        // if doubt, default 60
    this.lastPos    = 60;
    this.timer      = null;
    this.expandable = false;

    // sets current position of sidebar to pos
    this.setCurrPos = function(pos) {
        this.currPos = pos;

        $('aside.sidebar').css('width', this.currPos);
        $('.container-inner').css('margin-left', this.currPos);
        $('.drag-bar').css('left', this.currPos);
        // $('aside.sidebar > nav').css('width', this.currPos);
        // $('aside.sidebar > nav > ul').css('width', this.currPos+15);
        // $('.sidebarOuter').css('width', this.currPos);
    };

    this.isMin = function() {
        return this.currPos <= this.min;
    };

    this.isMax = function() {
        return this.currPos >= this.max;
    };

    // TODO
    // what does this do? curtis

    // Response to undated comment
    // sets the javascript object value to determine
    // if the sidebar should always be moveable
    // DL Sep 26 2014
    this.alwaysExpandable = function(newValue) {
        this.expandable = newValue || this.expandable;
        this.expandable = !!this.expandable; // recast to boolean
        return !!this.expandable;
    };

    // TODO
    this.relabel = function() {

        // get window width
        var vp = $(window).viewportW();
        // get current position
        var cp = this.currPos;
        var th = threshold * this.max;

        if (vp < mdMin) {
            // always hide labels at tablet size
            this.hidelabel();
        } else if (this.currPos < threshold * this.max) {
            this.hidelabel();
        } else {
            this.showlabel();
        }

        if (this.currPos == this.min) {
            $('.sidebar').addClass('sidebar-closed');
            $('.sidebar').removeClass('sidebar-open');
        } else {
            $('.sidebar').removeClass('sidebar-closed');
            $('.sidebar').addClass('sidebar-open');
        }
    };

    this.showlabel = function() {
        $('.sidebar').find('.sidebar-item-label').removeClass('hide');
        $.removeCookie('MesdPresentationHideSidebarLabels', {path: '/', expires: 30});
    };

    this.hidelabel = function() {
        $('.sidebar').find('.sidebar-item-label').addClass('hide');
        $.cookie('MesdPresentationHideSidebarLabels', 1, {path: '/', expires: 30});
    };

    this.close = function() {
        $.cookie('MesdPresentationSidebarClosed', 1, {path: '/', expires: 30});
    };

    this.open = function() {
        // $.removeCookie('MesdPresentationSidebarClosed');
        $.cookie('MesdPresentationSidebarClosed', 0, {path: '/', expires: 30});
    };

    // remove labels if sidebar closed
    this.finishMove = function() {
        this.relabel();
        $.cookie('MesdPresentationSidebarSize', this.currPos, {path: '/', expires: 30});
    };

    this.hideHandle = function(){
        $('.drag-bar').addClass('hide');
    };

    this.showHandle = function(){
        $('.drag-bar').removeClass('hide');
    };

};

function sidebarToggle(){
    if ($('.sidebar').hasClass('sidebar-closed')) {
        sidebar.open();
        sidebar.lastPos = sidebar_size;
        sidebar.setCurrPos(sidebar_size);
    } else {
        sidebar.close();
        sidebar.lastPos = 60;
        sidebar.setCurrPos(60);
    }
}



handleDoubleClick =
function(e) {
    var vp = $(window).viewportW();
    if (vp > small_screen) {
        e.preventDefault();

        // if viewport is larger than mdmin or always expandable
        // allow moveable
        if (vp >= mdMin || sidebar.alwaysExpandable()) {

            $('.sidebar').find('.hideable').toggleClass('hide');
            if (e.pageX) {
                var xcoord = e.pageX;

                if(sidebar.max >= e.pageX - 6 && sidebar.max <= e.pageX + 6) {
                    xcoord = sidebar.min;
                } else if (sidebar.min <= e.pageX + 6 && sidebar.min >= e.pageX - 6) {
                    xcoord = sidebar.max;
                } else if (sidebar.max > e.pageX - 1) {
                    xcoord = sidebar.min;
                } else {
                    xcoord = sidebar.max;
                }

                sidebar.lastPos = xcoord;
                sidebar.setCurrPos(xcoord);

                if (sidebar.min == xcoord) {
                    sidebar.close();
                } else {
                    sidebar.open();
                }

            } else {
                sidebarToggle();
            }
        }

        sidebar.finishMove();
    }
};

sidebarDoubleClick = function(e) {
    var vp = $(window).viewportW();
    if (vp > small_screen) {
        e.preventDefault();
        sidebarToggle();
        sidebar.finishMove();
    }
};

$('.drag-bar-handle').dblclick(handleDoubleClick);
$('#rest-of-sidebar').dblclick(sidebarDoubleClick);
// $('#rest-of-sidebar').click(sidebarClick);

$(document).mousemove(function(e) {
    var vp = $(window).viewportW();
    if (clicking && vp > small_screen) {
        if (e.pageX < sidebar_size) {
            if (vp >= mdMin || sidebar.alwaysExpandable()) {
                var xcoord = e.pageX - 1;
                if (0 >= e.pageX - 1) {
                    xcoord = 0;
                } else if (vp - 2 <= e.pageX) {
                    xcoord = vp - 2;
                } else {
                    xccord = e.pageX - 1;
                }
                if (xcoord < sidebar.min) {
                    xcoord = sidebar.min;
                }
                sidebar.lastPos = xcoord;
                sidebar.setCurrPos(xcoord);
                sidebar.finishMove();
            }
            if (vp < mdMin) {
                sidebar.lastPos = sidebar.currPos;
            } else {
                // do nothing
            }
        }
    }
});

$('.drag-bar').mousedown(function(e){
    e.preventDefault();
    clicking = true;
});

$(document).mouseup(function(e){
    e.preventDefault();
    clicking = false;
});

$(window).resize(function(){
    var vp = $(window).viewportW();

    if (vp <= sidebar.currPos) {

            // if size is smaller than minimum,
            // resize sidebar to current size
            sidebar.setCurrPos(vp);
            sidebar.lastPos = vp;

        } else if (vp < mdMin) {

            // if tablet size or smaller, close sidebar
            // and remember last position
            if (sidebar.isMin()) {
                // do nothing
            } else if (sidebar.isMax()) {
                sidebar.lastPos = sidebar_size;
            } else {
                sidebar.lastPos = sidebar.currPos;
            }
            sidebar.setCurrPos(sidebar.min);

        // }   else if(1 == sidebar.isMin) {

            // if we are at minimum already
            // and size is tablet or greater,
            // do nothing

        // }   else if (1 == sidebar.isMax ) {

            // if we are at maximum already
            // and size is tablet or greater,
            // do nothing

        } else {
            sidebar.setCurrPos(sidebar.lastPos);
        }

        if (vp >= mdMin || sidebar.alwaysExpandable()) {
            sidebar.showHandle();
        } else {
            sidebar.hideHandle();
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
}(jQuery));

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

$(document).ready(function() {
    // on page load, if sidebar cookie is scrolled, go back to position
    if ($.cookie('sscroll') !== null) {
        $('#sidebar').scrollTop($.cookie('sscroll'));
    }


    // on page load, if container-inner cookie is scrolled, go back to position

    // if there is a div.alert ... then do not scroll
    // this may be modified by user settings
    // user settings not yet implemented
    // DL Sept 17, 2014

    if ($.cookie('cscroll') !== null && (0 === $('div.alert').length)) {
        $('#container-inner').scrollTop($.cookie('cscroll'));
    }

    if ($('.always-expandable').length) {
        sidebar.alwaysExpandable(true);
    }

    // set cookies to minimum if null
    if ($.cookie('MesdPresentationSidebarSize') === null) {
        $.cookie('MesdPresentationSidebarSize', 60, {path: '/', expires: 30});
    }

    // set cookies to open if zero or greater
    if ($.cookie('MesdPresentationSidebarSize') <= 0) {
        $.cookie('MesdPresentationSidebarSize', sidebar_size, {path: '/', expires: 30 });
        $.removeCookie('MesdPresentationHideSidebarLabels', {path: '/'});
        sidebar.setCurrPos(sidebar_size);
        sidebar.finishMove();
        sidebar.open();
    } else {
        // do nothing
    }

    // set cookies to minimum if 60 and under
    if ($.cookie('MesdPresentationSidebarSize') <= 60 ) {
        $.cookie('MesdPresentationSidebarSize', 60, {path: '/', expires: 30});
        sidebar.setCurrPos(60);
        sidebar.finishMove();
        sidebar.close();
    } else {
        sidebar.open();
    }

    // set the viewport width
    var vp = $(window).viewportW();

    // TODO what's happening here?

    // Response to undated comment:
    // If we go to to less than tablet size via shrinking,
    // minimize sidebar
    // DL Sep 26 2014

    if (vp < mdMin) {
        sidebar.setCurrPos(60);
        sidebar.finishMove();
        sidebar.close();
        sidebar.hideHandle();
    } else {
        sidebar.showHandle();
    }

    // TODO fix up some odd issues if they login without a cookie.

    // Response to undated comment:
    // What are those issues?
    // DL Sep 26 2014
});