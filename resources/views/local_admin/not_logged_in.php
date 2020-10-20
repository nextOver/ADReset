<!DOCTYPE html>
<?php
$pageTitle = 'Log In';
    require_once(RESOURCE_DIR . 'templates/header.php');
?>
<body>
<!-- Navigation Menu Starts -->
<?php
    require_once(RESOURCE_DIR . 'templates/not_loggedin_navigation.php');
?>
<!-- Navigation Menu Ends -->
<div class="container" id="mainContentBody">
    <div class="col-md-12">
        <form class="form-horizontal" method="post" action="localadmin.php" name="loginform">
          <fieldset>
            <h2 class="topHeader">Administrador local login</h2>
    <div class="col-md-12">
        <?php
            // Show potential feedback from the login object
            if (FlashMessage::flashIsSet('LoginError')) {
                FlashMessage::displayFlash('LoginError', 'error');
            }
            elseif (FlashMessage::flashIsSet('LoginMessage')) {
                FlashMessage::displayFlash('LoginMessage', 'message');
            }
            elseif (FlashMessage::flashIsSet('RegisterSuccess')) {
                FlashMessage::displayFlash('RegisterSuccess', 'message');
            }
        ?>
    </div>
            <div class="form-group">
              <label for="inputUsername" class="col-lg-2 control-label">Nome de usuário:</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="inputUsername" placeholder="Username" name="user_name" required="on">
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword" class="col-lg-2 control-label">Senha:</label>
              <div class="col-lg-10">
                <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="user_password" autocomplete="off" required="on">
              </div>
            </div>
            <br />
            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary" name="login" value="Log in">Entrar</button>
                <button class="btn btn-default" type="reset">Reset</button>
              </div>
            </div>
          </fieldset>
        </form>
    </div>
</div>
</body>
</html>