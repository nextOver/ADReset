$(document).ready(function(){
    $('#resetSecretQuestions input').on('click', function(e){
        bootbox.confirm("Tem certeza de que deseja apagar suas respostas secretas? Você terá que definir suas três respostas secretas novamente antes de poder redefinir sua senha usando perguntas secretas.", function(result) {
            if (result) {
                $(e.target).closest("form").submit();
                return true;
            }
        });

        return false;
    });
});