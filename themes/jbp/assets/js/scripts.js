
$(document).ready(function () {
    /* activate scrollspy menu */
    $('body').scrollspy({
        target: '#navbar-collapsible',
        offset: 50
    });

    /* smooth scrolling sections */
    $('a[href*=#]:not([href=#])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

            if (this.hash.slice(1) == "count-page") {
                $(document).prop('title', 'B2M | Beranda');
            } else if (this.hash.slice(1) == "form-gabung-home") {
                $(document).prop('title', 'B2M | Form Pendaftaran');
            } else if (this.hash.slice(1) == "form-gabung-home") {
                $(document).prop('title', 'B2M | Form Pendaftaran');
            }

            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - 50
                }, 1000);
                return false;
            }
        }
    });

//    ANIMATED COUNTING IN HOMAPAGE   
    var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')
    $('#withdrawl-count').animateNumber(
            {
                number: 109360500,
                numberStep: comma_separator_number_step
            }, 5000
            );

//    Morris Donut Chart
    var colorsArray = ['#D2322D', '#18BC9C', '#FF9900'];
    new Morris.Donut({
        element: 'withdrawl-chart',
        colors: colorsArray,
        data: [
            {label: 'Market Share', value: 30},
            {label: 'Sytem Admin', value: 40},
            {label: 'System Reserved', value: 30}
        ]
    }).select(0);

});