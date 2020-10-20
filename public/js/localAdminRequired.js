$(document).ready(function() {
    $('.connectionSettingsLink').on('click', function() {
        bootbox.confirm("As configurações de conexão devem ser administradas como um administrador local. <br/> Faça login como um administrador local no formulário de login localadmin.php clicando em OK <br/> Observe que você será desconectado de sua sessão atual durante o processo.", function(result) {
            if (result) {
                window.location.href = "/account?logout&page=localadmin";
            }
        }); 
    });
});