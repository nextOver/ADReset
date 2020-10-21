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
    <form class="form-horizontal" method="post" action="resetpw.php" name="resetpwform">
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
                Este formulário permitirá que você redefina sua senha usando as perguntas secretas que você definiu anteriormente. Caso não tenha feito isso, você não poderá usar este recurso, portanto, entre em contato com o Help Desk para obter ajuda com a redefinição de sua senha. 
                 </div>
    </div>
    <div class="form-group">
        <label for="inputUsername" class="col-lg-3 control-label"><a href="#" class="tool-tip" data-toggle="tooltip" data-placement="top" data-original-title="Insira seu nome de usuário usado para logar no windows">Nome de usuário:</a></label>
        <div class="col-lg-4">
            <input type="text" class="form-control" id="inputUsername" placeholder="Nome de usuário" name="user_name" required="yes">
        </div>
    </div>
    <br />
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-3">
        <button type="submit" class="btn btn-primary" name="resetPasswordWithQuestions" value="Reset">Resetar senha</button>
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