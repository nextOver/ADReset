$(document).ready(function(){
    $('form.deleteAdminGroup input.btn-link').on('click', function(e){
        bootbox.confirm("Tem certeza de que deseja remover este grupo administrativo?", function(result) {
            if (result) {
                $(e.target).closest("form").submit();
                return true;
            }
        }); 

        return false;
    });

    $('form.deleteResetGroup input.btn-link').on('click', function(e){
        bootbox.confirm("Tem certeza de que deseja remover este grupo de redefinição?", function(result) {
            if (result) {
                $(e.target).closest("form").submit();
                return true;
            }
        }); 

        return false;
    });

    $('form.changeSecretQuestion input.btn-link').on('click', function(e){
        if ($(this).val() == 'Disable') {
            bootbox.confirm("Tem certeza de que deseja desativar esta pergunta secreta? Os usuários que usam esta pergunta secreta ainda poderão usar esta pergunta, no entanto, a pergunta não estará mais disponível para novas configurações.", function(result) {
                if (result) {
                    $(e.target).closest("form").submit();
                    return true;
                }
            });
        }
        else {
            $(e.target).closest("form").submit();
            return true;
        }

        return false;
    });

    $('#testEmailSettings').on('submit', function() {
        $sendBtn = $(this).find('[name=sendTestEmail]');
        $sendBtn.button('loading');
        $.ajax({
            url: $(this).attr('action'),
            type: 'post',
            cache: false,
            timeout: 10000,
            dataType: 'json',
            data: 'emailto=' + $(this).find('[name=email_testemailto]').val()
        }).done(function(response) {
            if (response.success) {
                $("#testEmailStatus").remove();
                $("#testEmailSettings").append('<div class="alert alert-success emailtest-alert" id="testEmailStatus"><a href="#" class="close" data-dismiss="alert">&times;</a>' + response.message + '</div>');
            }
            else {
                $("#testEmailStatus").remove();
                $("#testEmailSettings").append('<div class="alert alert-danger emailtest-alert" id="testEmailStatus"><a href="#" class="close" data-dismiss="alert">&times;</a>' + response.message + '</div>');
            }
        });

        setTimeout(function () {
            $sendBtn.button('reset');
            $('#testEmailSettings')[0].reset();
        }, 500);

        return false;
        
    });
});