<!DOCTYPE html>
<html lang="en">
<?php
$pageTitle = 'Connection Settings';
    require_once(__DIR__ . '/../../templates/header.php');
?>
<body>
<!-- Navigation Menu Starts -->
<?php
    require_once(__DIR__ . '/../../templates/local_navigation.php');
?>
<!-- Navigation Menu Ends -->
<!-- Content Starts -->
<div class="container" id="mainContentBody">
    <h2 class="topHeader">Configurações de conexão</h2>
    <h3>Bem vindo <?php echo ucwords($_SESSION['user_name']); ?>,</h3>
    <br />
    <div class="col-md-12">
        <?php
            // Show potential feedback from the settings changes object
            if (FlashMessage::flashIsSet('ChangeConnectionSettingsError')) {
                FlashMessage::displayFlash('ChangeConnectionSettingsError', 'error');
            }
            elseif (FlashMessage::flashIsSet('ChangeConnectionSettingsMessage')) {
                FlashMessage::displayFlash('ChangeConnectionSettingsMessage', 'message');
            }
        ?>
    </div>
    <h4>O que gostaria de alterar?</h4>
        <div class="panel-group" id="accordion">
            <!-- Mail Alias Columns Form -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Configurações de conexão com domínio
                    </h4>
                </div>
                <div id="collapse4" class="panel-collapse ">
                    <div class="panel-body">
                        <p class="systemSettingsSubheader">
                           
                            Insira as informações de conexão abaixo:
                        </p>
                    <form class="form-horizontal" method="post" action="/settings/connectionsettings.php" name="updateConnectionSettings">
                    <fieldset>
                        <div class="form-group">
                            <label for="inputDomainController" class="col-lg-2 control-label">
                                <a class="tool-tip" data-toggle="tooltip" data-placement="top" data-original-title="Digite o nome do controlador de domínio aqui. Exemplo:'dc1.example.local'">Controlador de domínio:</a>
                            </label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputDomainController" placeholder="Nome DNS do controlador de domínio" name="connection_dc" value="<?php echo preg_replace('{^.*//}', '' , $connectiongSettings->get('DC')); ?>" autocomplete="on">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPort" class="col-lg-2 control-label">
                                <a class="tool-tip" data-toggle="tooltip" data-placement="top" data-original-title="Insira a porta do LDAP aqui. A porta padrão SSL é '636'.">porta LDAP:</a>
                            </label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputPort" placeholder="LDAPS Port" name="connection_port" value="<?php echo $connectiongSettings->get('port'); ?>" autocomplete="on">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputUsername" class="col-lg-2 control-label">
                                <a class="tool-tip" data-toggle="tooltip" data-placement="top" data-original-title="Digite o nome de usuário que será usado para se conectar ao Active Directory e redefinir as senhas.">Nome de usuário:</a>
                            </label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputUsername" placeholder="Nome de usuário" name="connection_username" value="<?php echo $connectiongSettings->get('username'); ?>" autocomplete="on">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-lg-2 control-label">Senha:</label>
                            <div class="col-lg-10">
                                <input type="password" class="form-control" id="inputPassword" placeholder="Senha do usuário" name="connection_password" value="" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputDomainName" class="col-lg-2 control-label">
                                <a class="tool-tip" data-toggle="tooltip" data-placement="top" data-original-title="Digite o nome do Domínio. Um exemplo seria 'example.local'">Nome do domínio:</a>
                            </label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputDomainName" placeholder="Domain Name" name="connection_domainName" value="<?php echo $connectiongSettings->get('domainName'); ?>" autocomplete="on">
                            </div>
                        </div>
                        <br />
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" class="btn btn-primary" name="ChangeConnectionSettings" value="Change Connection Settings">Atualizar</button>
                                <button class="btn btn-default" type="reset">Reset</button>
                            </div>
                        </div>
                    </fieldset>
                    </form>
                    </div>
                </div>
            </div>
      </div> 
</div>
<!-- Content Ends -->
</body>
</html>