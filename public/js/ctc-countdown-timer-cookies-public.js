jQuery(document).ready(function ($) {
    'use strict';

    var ctc_coutdown_id = 'ctc_countdown_' + ctc_options._ctc_id + '_' + ctc_options._ctc_reset

    var timeout = get_time_in_secondes();
    var countDownDate = new Date();
    countDownDate.setSeconds(countDownDate.getSeconds() + timeout);
    var timestamp = countDownDate.getTime();

    if (localStorage.getItem(ctc_coutdown_id) == null)
    {
        //store current time into local storage
        localStorage.setItem(ctc_coutdown_id, timestamp);
    }


    var x = setInterval(function () {

        var now = new Date().getTime();
        // Find the distance between current time and store time
        var distance = localStorage.getItem(ctc_coutdown_id) - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        $('#ctc_countdown').find('.days').html(days);
        $('#ctc_countdown').find('.hours').html(hours);
        $('#ctc_countdown').find('.minutes').html(minutes);
        $('#ctc_countdown').find('.seconds').html(seconds);
        //check conditon of distance 
        if (distance < 0) {
            clearInterval(x);
            if(ctc_options._ctc_url_redirect === ''){
                $('#ctc_countdown').html(ctc_options._ctc_message)
            }else{
            window.location.replace(ctc_options._ctc_url_redirect);

            }
        }
    }, 1000);


    function get_time_in_secondes() {
        var ctc_days = 0, ctc_hours = 0, ctc_minutes = 0, ctc_secondes = 0;

        if (ctc_options._ctc_days != '' || ctc_options._ctc_days != 0)
            ctc_days = Math.floor(ctc_options._ctc_days * 60 * 60 * 24);


        if (ctc_options._ctc_hours != '' || ctc_options._ctc_hours != 0)
            ctc_hours = Math.floor(ctc_options._ctc_hours * 60 * 60);

        if (ctc_options._ctc_minutes != '' || ctc_options._ctc_minutes != 0)
            ctc_minutes = Math.floor(ctc_options._ctc_minutes * 60);


        if (ctc_options._ctc_secondes != '' || ctc_options._ctc_secondes != 0)
            ctc_secondes = Math.floor(ctc_options._ctc_secondes);


        return Math.floor(ctc_days + ctc_hours + ctc_minutes + ctc_secondes);
    }
});
