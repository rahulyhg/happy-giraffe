var Test = {
    Init:function () {

    },
    Start:function () {
        $('#step0').fadeOut(300, function () {
            $('#step1').fadeIn(300);
        });
    },
    Next:function (input) {
        if ($(input).attr('data-last') == "1") {
            $(input).closest('div.question-div').fadeOut(300, function () {
                Test.Finish();
            })
            return;
        }
        $(input).closest('div.question-div').fadeOut(300, function () {
            if ($(input).closest('div.question-div').next('div.question-div').length) {
                $(input).closest('div.question-div').next('div.question-div').fadeIn(300);
            } else {
                Test.Finish();
            }
        });

    },
    Finish:function () {
        var points = 0;
        $('div.question input[type="radio"]:checked').each(function (index, el) {
            points += parseInt($(el).attr('data-points'));
        });

        var finished = false;
        $('div.result-div').each(function (index, el) {
            if (finished)
                return;
            result_points = parseInt($(el).attr('data-points'));
            if (points >= result_points) {
                $(el).fadeIn(300);
                finished = true;
            }
        });
    },
    Restart:function () {

    }
}