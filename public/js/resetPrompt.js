$(document).ready(function(){
    $('#resetpw').on('click', function(e) {
        bootbox.dialog({
          message: "Por qual método você gostaria de redefinir sua senha?",
          title: "Reset de senha",
          buttons: {
            success: {
              label: "Email",
              className: "btn-primary",
              callback: function() {
                window.location.href = "/resetpwemail";
              }
            },
            main: {
              label: "Perguntas secretas",
              className: "btn-default",
              callback: function() {
                window.location.href = "/resetpw";
              }
            }
          }
        });

        return false;
    });
});
