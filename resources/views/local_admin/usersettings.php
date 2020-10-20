<!DOCTYPE html>
<html lang="en">
<?php
$pageTitle = 'Settings';
    require_once(RESOURCE_DIR . 'templates/header.php');
?>
<body>
<!-- Navigation Menu Starts -->
<?php
    require_once(RESOURCE_DIR . 'templates/local_navigation.php');
?>
<!-- Navigation Menu Ends -->
<!-- Content Starts -->
<div class="container" id="mainContentBody">
    <h2 class="topHeader">Settings</h2>
    <h3>Bem vindo <?php echo ucwords($_SESSION['user_name']); ?>,</h3>
    <br />
    <div class="col-md-12">
        <?php
            // Show potential feedback from the settings changes object
            if (FlashMessage::flashIsSet('ChangePWError')) {
                FlashMessage::displayFlash('ChangePWError', 'error');
            }
            elseif (FlashMessage::flashIsSet('ChangePWMessage')) {
                FlashMessage::displayFlash('ChangePWMessage', 'message');
            }
            elseif (FlashMessage::flashisSet('ChangeProfileMessage')) {
                FlashMessage::displayFlash('ChangeProfileMessage', 'message');
            }
            elseif (FlashMessage::flashisSet('ChangeProfileError')) {
                FlashMessage::displayFlash('ChangeProfileError', 'error');
            }
        ?>
    </div>
    <h4>O que você gostaria de fazer?</h4>
    <div class="panel-group" id="accordion">
        <!-- Change Password Form -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Alterar senha</a>
                </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse">
                <div class="panel-body">
                <form class="form-horizontal" method="post" action="/settings/localusersettings.php" name="loginform">
                    <fieldset>
                    <div class="form-group">
                        <label for="inputOldPassword" class="col-lg-2 control-label">Senha antiga:</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="inputOldPassword" placeholder="Senha antiga" name="user_oldpassword" value="" autocomplete="off" required="yes">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNewPassword" class="col-lg-2 control-label">Nova senha (<?php echo Config::get('security/passwordLength') ?>+ Caracteres):</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="inputNewPassword" placeholder="Nova senha" name="user_newpassword" pattern=<?php echo '".{', Config::get('security/passwordLength'), ',}"' ?> value="" autocomplete="off" required="yes">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputConfirmNewPassword" class="col-lg-2 control-label">Confirmar nova senha:</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="inputConfirmNewPassword" placeholder="Nova senha" name="user_confirmnewpassword" pattern=<?php echo '".{', Config::get('security/passwordLength'), ',}"' ?> value="" autocomplete="off" required="yes">
                        </div>
                    </div>
                    <br />
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-primary" name="changePassword" value="Change Password">Atualizar</button>
                            <button class="btn btn-default" type="reset">Reset</button>
                        </div>
                    </div>
                </fieldset>
                </form>
                </div>
            </div>
        </div>

        <!-- Change Profile Form -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Alterar perfil</a>
                </h4>
            </div>
            <div id="collapse2" class="panel-collapse collapse">
                <div class="panel-body">
                <form class="form-horizontal" method="post" action="/settings/localusersettings.php" name="loginform">
                    <fieldset>
                    <div class="form-group">
                        <label for="inputNewUsername" class="col-lg-2 control-label">Nome de usuário:</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="inputNewUsername" placeholder="Nome de usuário" name="user_newusername" value=<?php echo '"' . sanitize($_SESSION['user_name']) . '"';?> autocomplete="off" required="yes">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNewName" class="col-lg-2 control-label">Nome:</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="inputNewName" placeholder="Nome" name="user_newname" value=<?php echo '"' . sanitize($userInfo->get()['name']) . '"';?> autocomplete="off" required="yes">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputNewEmail" class="col-lg-2 control-label">Email:</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="inputNewEmail" placeholder="Email" name="user_newemail" value=<?php echo '"' . sanitize($userInfo->get()['email']) . '"';?> autocomplete="off">
                        </div>
                    </div>
                    <br />
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="submit" class="btn btn-primary" name="changeProfile" value="Change Profile">Atualizar</button>
                            <button class="btn btn-default" type="reset">Reset</button>
                        </div>
                    </div>
                </fieldset>
                </form>
                </div>
            </div>
        </div>

        <!-- Change ..... Form -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Configurações de segurança</a>
                </h4>
            </div>
            <div id="collapse3" class="panel-collapse collapse">
                <div class="panel-body">
                    Nenhuma configuração de segurança pode ser configurada ainda.
                </div>
            </div>
        </div>

    </div> 

</div>
<!-- Content Ends -->
</body>
</html>