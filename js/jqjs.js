
jQuery(document).ready(function ($) {
    /* show */
    $('#appomed-overlay').css('visibility', 'visible');
    $('#appomed-overlay').css('opacity', '1');
    $('#appomed-pop-main').css('visibility', 'visible');
    $('#appomed-pop-main').css('opacity', '1');

    /* click to close */
    $('#appomed-pop-close').click(appomedclosepop);
    $('#appomed-pop-but').click(appomedclosepop);

    /* close function */
    function appomedclosepop() {
        setTimeout($('#appomed-overlay').css('visibility', 'hidden'), 500);
        $('#appomed-overlay').css('opacity', '0');
        setTimeout($('#appomed-pop-main').css('visibility', 'hidden'), 500);
        $('#appomed-pop-main').css('opacity', '0');
        var cookieName = 'ap';
        var cookieValue = 'ap';
        var myDate = new Date();
        myDate.setMonth(myDate.getMonth() + 12);
        document.cookie = cookieName + "=" + cookieValue + "; path=/; expires=" + myDate;

    }
});