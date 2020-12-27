// Handle Form Login
$(document).ready(function() {
    $('.formLogin').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnLogin').prop('disabled', true);
                $('.btnLogin').html('<i class="fa fa-spin fa-spinner"> Processing</i>');
            },
            complete: function() {
                $('.btnLogin').prop('disabled', false);
                $('.btnLogin').html('Login');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.emailaddr){
                        $('#emailaddr').addClass('is-invalid');
                        $('.errorEmailAddr').html(response.error.emailaddr);
                    }
                    else
                    {
                        $('#emailaddr').removeClass('is-invalid');
                        $('.errorEmailAddr').html('');
                    }

                    if (response.error.pass){
                        $('#pass').addClass('is-invalid');
                        $('.errorPass').html(response.error.pass);
                    }
                    else
                    {
                        $('#pass').removeClass('is-invalid');
                        $('.errorPass').html('');
                    }
                }
                else
                {
                    window.location = response.success.link;
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });

        return false;
    })
});