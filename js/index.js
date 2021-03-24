window.onload = function() {
    var btn_go = document.getElementById("btn_go");
    preload = async function() {
        var $preloader = $('#page-preloader'),
            $spinner = $preloader.find('.spinner');
        $spinner.fadeOut();
        $preloader.delay(350).fadeOut('slow');
    }
    btn_go.onsubmit = function() {
        preload();
    }




}