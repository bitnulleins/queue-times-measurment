/**
 * Source Code by bit01.de
 */

$(document).ready(function() {

    var totalSeconds = 0;
    var interval;
    var startDate;
    var endDate;

    var messungen = 0;

    $('input[type=radio]').click(function() {
        $('#toggleTime').prop('disabled',false);
    });

    $('#toggleTime').click(function() {
        if ($(this).text() == "Start measurement") {
            startDate = new Date().getTime();

            startTimer();

            $(this).text("Stop measurement");
            $('.record').toggle();
            $('#cancel').prop('disabled', false);
            //$('input[type=radio]').prop('disabled', true);
        } else {
            endDate = new Date().getTime();

            stopTimer();

            console.log({location:$('input[name=location]:checked').val(),dateStart:startDate,dateEnd:endDate});
            jQuery.ajax({
                url: "./saveToCSV.php",
                data: {location:$('input[name=location]:checked').val(),dateStart:startDate,dateEnd:endDate},
                type: "POST",
                beforeSend: function() {
                    $('.record').text("Measurement will saved...");
                },
                success: function(data) {
                    $('.record').css('background-color','darkgreen');
                    $('.record').text("Measurement successfully saved!");

                    messungen++;
                    $('#amount').text(messungen);
                },
                error: function() {
                    $('.record').text("Measurement can't be saved!");
                }
            });

            setTimeout(function(){
                resetTimer();
                $('.record').toggle();
            },1000);


            $(this).text("Start measurement");
            //$('input[type=radio]').prop('disabled', false);
            $('#cancel').prop('disabled', true);
        }
    });


    $('#cancel').click(function() {
        $('#toggleTime').text("Start measurement");
        stopTimer();
        resetTimer();
        $('.record').hide();
        //$('input[type=radio]').prop('disabled', false);
    });

    function startTimer() {
        totalSeconds = 0;
        interval =  getInterval();
    }

    function resetTimer() {
        totalSeconds = 0;
        $('#countup').text(0 + "s");
        $('.record').css('background-color','red');
        $('.record').html('Measurement started...');
    }

    function stopTimer() {
        clearInterval(interval);
    }

    function getInterval() {
        function setTime() {
            totalSeconds = Math.round((new Date().getTime() - startDate)/1000);
            if (totalSeconds >= 60) {
                $('#countup').text(parseInt(totalSeconds/60) + "min " + (totalSeconds % 60) +  "s");
            } else {
                $('#countup').text(totalSeconds % 60 + "s");
            }
        }

        return setInterval(setTime, 1000);
    }

});