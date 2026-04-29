$(document).ready(function () {
    $(".nav-link").click(function () {
        // remove active class from all
        $(".nav-link").removeClass("active");
        $(this).addClass("active");
        // hide all content
        $(".tab-pane").removeClass("active");
        // show selected
        let target = $(this).data("target");
        $("#" + target).addClass("active");
    });
});