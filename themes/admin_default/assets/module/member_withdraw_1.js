$(window).unload(function () {
    $('select option').remove();
});

$(document).ready(function () {
    $('#cmb-type').val('0');
    if (!$("#wd-value").hasClass("hidden")) {
        $('#wd-value').addClass('hidden');
    }
    if (!$("#cmb-bank").hasClass("hidden")) {
        $('#cmb-bank').addClass('hidden');
    }
    if (!$("#wd-item").hasClass("hidden")) {
        $('#wd-item').addClass('hidden');
    }
});

$('#cmb-type').on('change', function () {
    if (this.value === '0') {
        if (!$("#wd-value").hasClass("hidden")) {
            $('#wd-value').addClass('hidden');
        }
        if (!$("#cmb-bank").hasClass("hidden")) {
            $('#cmb-bank').addClass('hidden');
        }
        if (!$("#wd-item").hasClass("hidden")) {
            $('#wd-item').addClass('hidden');
        }
    } else if (this.value === '1') {
        $('#wd-value').removeClass('hidden');
        $('#cmb-bank').removeClass('hidden');

//        if (!$("#wd-value").hasClass("hidden")) {
//            $('#wd-value').addClass('hidden');
//        }
//        if (!$("#cmb-bank").hasClass("hidden")) {
//            $('#cmb-bank').addClass('hidden');
//        }
        if (!$("#wd-item").hasClass("hidden")) {
            $('#wd-item').addClass('hidden');
        }
    } else if (this.value === '2') {
        $('#wd-value').removeClass('hidden');
        $('#wd-item').removeClass('hidden');

//        if (!$("#wd-value").hasClass("hidden")) {
//            $('#wd-value').addClass('hidden');
//        }
        if (!$("#cmb-bank").hasClass("hidden")) {
            $('#cmb-bank').addClass('hidden');
        }
//        if (!$("#wd-item").hasClass("hidden")) {
//            $('#wd-item').addClass('hidden');
//        }
    } else {
        $('#wd-value').removeClass('hidden');
//        $('#wd-item').removeClass('hidden');

//        if (!$("#wd-value").hasClass("hidden")) {
//            $('#wd-value').addClass('hidden');
//        }
        if (!$("#cmb-bank").hasClass("hidden")) {
            $('#cmb-bank').addClass('hidden');
        }
        if (!$("#wd-item").hasClass("hidden")) {
            $('#wd-item').addClass('hidden');
        }
    }
});
/* EOF NEW OBJECT(GET SIZE OF ARRAY) */