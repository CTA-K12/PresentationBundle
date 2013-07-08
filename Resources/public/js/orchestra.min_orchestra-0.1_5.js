$('.toggle-bar').click(function() {
    // animations off
    /*
    $('.toggle-bar').toggleClass('toggle-bar-open toggle-bar-closed');
    $('.toggle-bar-handle i').toggleClass('icon-chevron-left icon-chevron-right');
    $('.toggle-bar-handle').toggleClass('toggle-bar-handle-open toggle-bar-handle-closed');
    $('#sidebar').toggleClass('sidebar-min');
    $('#sidebar span').toggleClass('hide');
    $('.row-fluid-content').toggleClass('row-fluid-content-max');
    */

    // animations on
    $('.toggle-bar-open').switchClass('toggle-bar-open', 'toggle-bar-closed', 500);
    $('.toggle-bar-closed').switchClass('toggle-bar-closed', 'toggle-bar-open', 500);
    $('.toggle-bar-handle').toggleClass('toggle-bar-handle-open toggle-bar-handle-closed');
    $('.toggle-bar-handle span').toggleClass('icon-chevron-left icon-chevron-right');
    $('.sidebar').switchClass('', 'sidebar-min', 500);
    $('.sidebar-min').switchClass('sidebar-min', '', 500);
    $('.sidebar .hideable').delay(250).queue(function(){
        $(this).toggleClass('hide');
        $(this).dequeue();
    });
    $('.row-fluid-content').switchClass('', 'row-fluid-content-max', 500);
    $('.row-fluid-content-max').switchClass('row-fluid-content-max', '', 500);

    // set sidebar cookie
    $('.sidebar .hideable').delay(600).queue(function(){
        if($(this).hasClass('hide')) {
            $.cookie('sbar', 'closed');
        }
        else {
            $.removeCookie('sbar');
        }
        $(this).dequeue();
    });
});

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
        $('.sidebar span').toggleClass('hide');
        $('.row-fluid-content').toggleClass('row-fluid-content-max');
    }

});