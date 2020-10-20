$(document).ready(function() {
    bootbox.alert("Você ainda não possui perguntas secretas configuradas. Para poder redefinir sua senha do Windows (Active Directory) usando perguntas secretas, você precisará fazer o login e defini-las.", function() {
        window.location.href = "/account";
    });
});