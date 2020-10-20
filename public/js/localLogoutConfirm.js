$(document).ready(function() {
    $('.navbar-brand').on('click', function() {
        bootbox.confirm("Acessar a página inicial fará o seu logout como administrador local. <br/> Deseja continuar?", function(result) {
            if (result) {
                window.location.href = "/index";
            }
        }); 
    });
});