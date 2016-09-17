$(document).ready(function(){

    $('.play-choice').off('click').on('click', function(){

        var $button = $(this);

        $('#answer-checker').show();

        var formData = 'alias=' + $('#alias').html() + '&choice=' + $button.data('choice');

        $.ajax({
          type: 'POST',
          url: '/answer',
          data: formData,

          success: function(data) {

            var response = JSON.parse(data);

            $('.play-choice').attr('disabled', 'disabled');

            if (response.correct) {
                $button.removeClass('btn-primary');
                $button.addClass('btn-success');
                $('#answer-checker').html('<i style="color:#449D44;" class="fa fa-check fa-2x"></i>');
            }else{
                $button.removeClass('btn-primary');
                $button.addClass('btn-danger');
                $('#answer-checker').html('<i style="color:#C9302C;" class="fa fa-times fa-2x"></i>');
            }

            setTimeout(function(){
                window.location.reload();
            }, 1000);

          }
        });

    });

    var index = 1;
    var interval = setInterval(function(){
        if (index > 105) {
            clearInterval(interval);
            window.location.reload();
        }
        var width = index.toString() + '%';
        $('.counter-bar').css('width', width);
        index++;
    }, 100);
    
});