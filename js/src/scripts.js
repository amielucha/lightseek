jQuery(document).ready(($) => {
    // initialize FitVids
    // documentation: https://github.com/davatron5000/FitVids.js
    // $(".front-page, .hentry").fitVids();

    $('#primary-menu').on('click', function(event) {
        if (event.target == this) { // only if the target itself has been clicked
            event.preventDefault();
            $('#menu-toggle').prop('checked', false);
        }
    });

    $(document).on('click', function(e) {
        if ($(e.target).is('.info-trigger')) {
            e.preventDefault();
            if ($(e.target).next().hasClass('active')) {
                $(e.target).next().toggleClass('active');
            } else {
                $(".info").removeClass('active');
                $(e.target).next().toggleClass('active');
            }
        } else {
            $('.info').removeClass('active');
        }
    });

    $(".home-screen-panel .panel .btn").hover(
        function() {
            $(this).closest(".inner-wrap").css("border-color", "#21a19f");
        },
        function() {
            $(this).closest(".inner-wrap").css("border-color", "#e8e8e8");
        }
    );


});

WebFont.load({
    google: {
        families: ['Open+Sans:400,400italic,600,600italic,700,700italic:latin'],
        families: ['Material+Icons'],
        //text: 'abcdedfghijklmopqrstuvwxyz!'
    }
});