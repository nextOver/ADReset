<!DOCTYPE html>
<?php
$pageTitle = 'Login';
    require_once(RESOURCE_DIR . 'templates/header.php');

    if (isset($_GET['notify']) && ($_GET['notify'] == 'yes')) {
      echo '<script src="/js/secretQuestionsNotice.js"></script>';
    }
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
<div class="col-md-12 card">
    <?php
      if (isset($_GET['page'])) {
        echo '<form class="form-horizontal" method="post" action="account.php?page=' . $_GET['page'] . '" name="loginform">';
      }
      else {
        echo '<form class="form-horizontal" method="post" action="account.php" name="loginform">';
      }
    ?>
      <fieldset>
        <h2 class="topHeader">Faça Login</h2>
<div class="col-md-12">
    <?php
        // Show potential feedback from the login object
        if (FlashMessage::flashIsSet('LoginError')) {
            FlashMessage::displayFlash('LoginError', 'error');
        }
        elseif (FlashMessage::flashIsSet('LoginMessage')) {
            FlashMessage::displayFlash('LoginMessage', 'message');
        }
    ?>
</div>
        <div class="form-group">
          <label for="inputUsername" class="col-lg-4 control-label"><a href="#" class="tool-tip" data-toggle="tooltip" data-placement="top" data-original-title="This is the same username that's used to login to your Windows computer.">Nome de usuário:</a>
</label>
          <div class="col-lg-4">
            <input type="text" class="form-control" id="inputUsername" placeholder="Username" name="user_name">
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword" class="col-lg-4 control-label">Senha:</label>

          <div class="col-lg-4">
            <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="user_password" autocomplete="off">
          </div>
        </div>
        <br />
        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-4">
            <button type="submit" class="btn btn-primary" name="login" value="Log in">Enviar</button>
            <button class="btn btn-default" type="reset">Resetar formulário</button>
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