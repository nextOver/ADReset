<?php
  require_once(RESOURCE_DIR . 'functions/ADPasswordPolicyMatch.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php
$pageTitle = 'Set New Password';
    require_once(RESOURCE_DIR . 'templates/header.php');
?>
<body>
<!-- Navigation Menu Starts -->
<?php
    require_once(RESOURCE_DIR . 'templates/not_loggedin_navigation.php');
?>
<!-- Navigation Menu Ends -->
<!-- Content Starts -->
<div class="container" id="mainContentBody">

<!-- Start of form inspired from http://bootswatch.com/flatly/ -->
<div class="col-md-12">
    <form class="form-horizontal" method="post" action="newpw.php" name="newpwform">
      <fieldset>
        <h2 class="topHeader">Configure uma nova senha</h2>
        <div class="col-md-12">
            <?php
                // Show potential feedback from the login object
                if (FlashMessage::flashIsSet('NewPWError')) {
                    FlashMessage::displayFlash('NewPWError', 'error');
                }
                elseif (FlashMessage::flashIsSet('NewPWMessage')) {
                    FlashMessage::displayFlash('NewPWMessage', 'message');
                }
            ?>
        </div>
        <div class="col-md-12">
            <div class="well resetPwWell">
            
            Para redefinir sua senha, basta digitar sua nova senha em cada caixa de texto e clicar no botão &quot;Resetar senha &quot;
            Lembre-se de que sua nova senha deve estar em conformidade com a <a href="#" class="tool-tip" data-html="true" data-toggle="tooltip" data-placement="top" data-original-title="<?php  echo ADPasswordPolicyWritten() ?>">política de senha</a>.
            </div>
        </div>
        <div class="form-group">
            <label for="login_input_password_new" class="col-lg-2 control-label">Senha:</label>
            <div class="col-lg-10">
                <input id="login_input_password_new" class="form-control" type="password" name="user_password_new" placeholder="Senha" required autocomplete="off" />
            </div>
        </div>

        <div class="form-group">
            <label for="login_input_password_repeat" class="col-lg-2 control-label">Repita a senha:</label>
            <div class="col-lg-10">
                <input id="login_input_password_repeat" class="form-control" type="password" name="user_password_repeat" placeholder="Repita a senha" required autocomplete="off" />
            </div>
        </div>
        <input type="hidden" name="id" value="<?php if (isset($_GET['id'])) { echo $_GET['id']; } elseif(isset($_GET['idq'])) { echo $_GET['idq']; } ?>">
        <br />
        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <button type="submit" class="btn btn-primary" name="setPassword" value="Set Password">Definir senha</button>
          </div>
        </div>
      </fieldset>
    </form>
</div>
<!-- End of Form -->

</div>
<!-- Content Ends -->
</body>
</html>