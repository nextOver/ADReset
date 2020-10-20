<!DOCTYPE html>
<html lang="en">
<?php
$pageTitle = 'Reset Password';
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
    <form class="form-horizontal" method="post" action="resetpwemail.php" name="resetpwform">
      <fieldset>
        <h2 class="topHeader">Resetar senha</h2>
    <div class="col-md-12">
        <?php
            // Show potential feedback from the login object
            if (FlashMessage::flashIsSet('ResetPWError')) {
                FlashMessage::displayFlash('ResetPWError', 'error');
            }
            elseif (FlashMessage::flashIsSet('ResetPWMessage')) {
                FlashMessage::displayFlash('ResetPWMessage', 'message');
            }
        ?>
    </div>
    <div class="col-md-12">
            <div class="well resetPwWell">   
              Este formulário permitirá que você redefina sua senha através do endereço de e-mail associado à sua conta. Depois de enviado, você receberá um e-mail com um link. Basta clicar no link e definir sua nova senha.
      </div>
        </div>
        <div class="form-group">
          <label for="inputUsername" class="col-lg-2 control-label"><a href="#" class="tool-tip" data-toggle="tooltip" data-placement="top" data-original-title="Enter the username you use to login to Windows.">Nome de usuário</a></label>
          <div class="col-lg-10">
            <input type="text" class="form-control" id="inputUsername" placeholder="Nome de usuário" name="user_name" required="yes">
            </div>
        </div>
        <br />
        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <button type="submit" class="btn btn-primary" name="resetPassword" value="Reset">Resetar senha </button>
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