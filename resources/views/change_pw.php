<!DOCTYPE html>
<?php
  require_once(RESOURCE_DIR . 'functions/ADPasswordPolicyMatch.php');
  $pageTitle = 'Change Password';
  require_once(RESOURCE_DIR . 'templates/header.php');
?>
<body>
<!-- Navigation Menu Starts -->
<?php
  if (LoginCheck::isLoggedInAsAdmin() && LoginCheck::isDomain()) {
    require_once(RESOURCE_DIR . '/templates/admin_navigation.php');
  }
  elseif (LoginCheck::isLoggedIn() && LoginCheck::isDomain()) {
    require_once(RESOURCE_DIR . '/templates/navigation.php');
  }
  elseif (LoginCheck::isLocal()) {
    header('location: /settings/localusersettings.php');
  }
  else {
      require_once(RESOURCE_DIR . '/templates/not_loggedin_navigation.php');
  }
?>
<!-- Navigation Menu Ends -->
<!-- Content Starts -->
<div class="container" id="mainContentBody">

<!-- Start of form inspired from http://bootswatch.com/flatly/ -->
<div class="col-md-12">
    <form class="form-horizontal" method="post" action="changepw.php" name="loginform">
      <fieldset>
        <h2 class="topHeader">Definir nova senha</h2>
<div class="col-md-12">
    <?php
        // Show potential feedback from the login object
        if (FlashMessage::flashIsSet('ChangePWError')) {
            FlashMessage::displayFlash('ChangePWError', 'error');
        }
        elseif (FlashMessage::flashIsSet('ChangePWMessage')) {
            FlashMessage::displayFlash('ChangePWMessage', 'message');
        }
    ?>
</div>
<div class="col-md-12">
      <div class="well resetPwWell">
      Para definir sua senha, basta preencher as caixas de texto abaixo e clicar no botão &quot; Alterar senha.&quot; Lembre-se de que sua nova senha deve estar em conformidade com a <a href="#" class="tool-tip" data-html="true" data-toggle="tooltip" data-placement="top" data-original-title="<?php  echo ADPasswordPolicyWritten() ?>">politica de senha</a>.
      </div>
</div>
<div class="form-group">
  <label for="inputUsername" class="col-lg-3 control-label"><a href="#" class="tool-tip" data-toggle="tooltip" data-placement="top" data-original-title="Este é o mesmo nome de usuário usado para logar em seu computador."
    >Nome de usuário:</a>
  </label>
  <div class="col-lg-4">
    <input type="text" class="form-control" id="inputUsername" placeholder="Insira seu nome de usuário" name="user_name" required="yes"
     <?php if (isset($_SESSION['user_name'])) 
        { echo "value=".$_SESSION['user_name'];
          echo " ";
          echo 'readonly="readonly"';

        }

     ?>

    >
  </div>
</div>
<div class="form-group">
  <label for="inputOldPassword" class="col-lg-3 control-label">Senha atual:</label>
  <div class="col-lg-4">
    <input type="password" class="form-control" id="inputOldPassword" placeholder="Insira sua senha atual" name="user_password" autocomplete="off" required="yes">
  </div>
</div>
<div class="form-group">
  <label for="inputNewPassword" class="col-lg-3 control-label">Nova senha:</label>
  <div class="col-lg-4">
    <input type="password" class="form-control" id="inputNewPassword" placeholder="Insira uma nova senha" name="user_new_password" autocomplete="off" required="yes">
  </div>
</div>
<div class="form-group">
  <label for="inputConfirmPassword" class="col-lg-3 control-label">Confirmar nova senha:</label>
  <div class="col-lg-4">
    <input type="password" class="form-control" id="inputConfirmPassword" placeholder="Confirme sua nova senha" name="user_confirm_password" autocomplete="off">
  </div>
</div>
<br />
<div class="form-group">
  <div class="col-lg-5 col-lg-offset-3">
    <img src="<?php echo $builder->inline(); ?>" />
  </div>
</div>
<div class="form-group">
  <label for="inputCaptcha" class="col-lg-3 control-label">Código de verificação:</label>
  <div class="col-lg-4">
    <input type="text" class="form-control" id="inputCaptcha" placeholder="Insira o código de verificação" name="user_captcha" autocomplete="off" required="yes"> 
  </div>
</div>
<br />
<div class="form-group">
  <div class="col-lg-5 col-lg-offset-3">
    <button type="submit" class="btn btn-primary" name="changepw" value="Change Password">Alterar senha</button>
    <button class="btn btn-default" type="reset">Resetar formulário</button>
  </div>
</div>
</fieldset>
</form>
</div>

 <div class="margin-bottom">
     <div> &nbsp;&nbsp;</div>
     <div> &nbsp;&nbsp;</div>
     <div> &nbsp;&nbsp;</div>
  </div>
<!-- End of Form -->

</div>
<!-- Content Ends -->
</body>
</html>