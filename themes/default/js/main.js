jQuery(document).ready(function (jQuery) {
    jQuery(".owl-carousel").owlCarousel({
        autoplay: true,
        autoplayTimeout: 3000,
        loop: true,
        items: 1,
        singleItem: true,
        stopOnHover: true
    });
    $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails",
        slideshow: false
    });

    /*menu left*/
    //var active = true;
    //$('#collapse-init').click(function () {
    //    if (active) {
    //        active = false;
    //        $('.panel-collapse').collapse('show');
    //        $('.panel-title').attr('data-toggle', '');
    //        $(this).text('Enable accordion behavior');
    //    } else {
    //        active = true;
    //        $('.panel-collapse').collapse('hide');
    //        $('.panel-title').attr('data-toggle', 'collapse');
    //        $(this).text('Disable accordion behavior');
    //    }
    //});
    //$('#accordion').on('show.bs.collapse', function () {
    //    if (active) $('#accordion .in').collapse('hide');
    //});
    /*menu left*/
});