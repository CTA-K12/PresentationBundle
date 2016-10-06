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

toggleSidebar = function() {
    $('.sidebar').toggleClass('sidebar-closed');
    $('.drag-bar').toggleClass('sidebar-closed');
    $('.container-inner').toggleClass('sidebar-closed');

    // toggling
    $.cookie('sidebar-closed', (parseInt($.cookie('sidebar-closed'),10) ? 0 : 1), {path: '/', expires: 30} );
}

$('.drag-bar-handle, .sidebar-extra').on('click', function(e) {
    e.preventDefault();
    toggleSidebar();
});

// $('.drag-bar').mousedown(function(e){
//     e.preventDefault();
//     // get the viewport width
//     var vp = $(window).viewportW();

//     // if viewport is larger than mdmin or always expandable
//     // allow moveable
//     if (vp >= mdMin || sidebar.alwaysExpandable()) {
//         $(document).mousemove(function(e) {
//             var xcoord = e.pageX - 1;
//             if (0 >= e.pageX - 1) {
//                 xcoord = 0;
//             } else if (vp - 2 <= e.pageX) {
//                 xcoord = vp - 2;
//             } else {
//                 xccord = e.pageX - 1;
//             }
//             if (xcoord < sidebar.min) {
//                 xcoord = sidebar.min;
//             }
//             sidebar.lastPos = xcoord;
//             sidebar.setCurrPos(xcoord);
//             sidebar.finishMove();
//         });
//     } else {
//         // do nothing
//     }
// });

$(document).mouseup(function(e){
    // get window width
    var vp = $(window).viewportW();

    if (vp < mdMin) {
        sidebar.lastPos = sidebar.currPos;
    } else {
        // do nothing
    }
    $(document).unbind('mousemove');
});

// when sidebar is scrolled, set a cookie of the scroll position
$('#sidebar').scroll(function() {
    $.cookie('sscroll', $('#sidebar').scrollTop());
});


$(document).ready(function() {
    // on page load, if sidebar cookie is scrolled, go back to position
    if ($.cookie('sscroll') !== null) {
        $('#sidebar').scrollTop($.cookie('sscroll'));
    }
});