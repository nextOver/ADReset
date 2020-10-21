<!DOCTYPE html>
<?php
    require_once('../resources/core/init.php');
$pageTitle = 'Home';
    require_once(RESOURCE_DIR . '/templates/header.php');
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
        header('location: /localadmin.php?logout');
    }
    else {
        require_once(RESOURCE_DIR . '/templates/not_loggedin_navigation.php');
    }
?>
<!-- Navigation Menu Ends -->
<?php
    if (FlashMessage::flashIsSet('passwordSetMessage')) {
        FlashMessage::runJsScript('passwordSetMessage');
    }
    elseif (FlashMessage::flashIsSet('InvalidCodeError')) {
        FlashMessage::runJsScript('InvalidCodeError');
    }
?>

<div class="container" id="mainContentBody">
    <div class="col-md-12">
        <form class="form-horizontal" method="post" action="index.php" name="loginform">
            <fieldset>
                <h2 class="topHeader">Portal de redefinição de senhas</h2>
                <br />
                <div class="col-md-12">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">                                    
                                O que você gostaria de fazer?
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse">
                                <div class="panel-body">
                                    <br />
                                    <p style="font-weight:normal; max-width:780px">                              
                                        Esta aplicação permite redefinir sua senha do Windows (Active Directory) por meio de perguntas secretas ou um e-mail cadastrado. 
                                        Para definir as perguntas secretas, clique em &quot;Definir perguntas&quot; 
                                        e faça login. Sua senha não pode ser redefinida por meio deste método até que suas perguntas secretas sejam definidas.
                                        Você também pode simplesmente alterar sua senha sem redefini-la, inserindo sua senha atual e sua nova senha. Para fazer isso, basta clicar em &quot;Alterar senha&quot;.
                                    </p><br />

                                    <p style="font-weight:normal" class="indexHeader">
                                        Selecione uma opção abaixo:
                                    </p>
                                    <p class="indexOptions">
                                        <?php
                                            if (LoginCheck::isLoggedInAsAdmin()) {
                                                echo '<a data-toggle="tooltip" data-title="Esta função está desativada porque você é um administrador" class="btn btn-primary disabled">Definir perguntas</a><br />';
                                            }
                                            else {
                                                echo '<a href="account" class="btn btn-primary">Definir perguntas</a><br />';
                                            }
                                        ?>
                                        <a href="changepw" class="btn btn-primary">Alterar senha</a><br />
                                        <?php
                                            if (LoginCheck::isLoggedIn()) {
                                                echo '<a data-toggle="tooltip" data-title="Esta função é desativada enquanto você está logado " class="btn btn-primary disabled">Reset com Email</a><br />';
                                                echo '<a data-toggle="tooltip" data-title="Esta função é desativada enquanto você está logado" class="btn btn-primary disabled">Reset com perguntas</a><br />';
                                            }
                                            else {
                                                echo '<a href="resetpw" class="btn btn-primary">Reset com perguntas</a><br />';

                                                $systemSettings = new SystemSettings;
                                                $isEmailResetEnabled = $systemSettings->getOtherSetting('emailresetenabled');
                                                if (isset($isEmailResetEnabled) && $isEmailResetEnabled == 'true') {
                                                    echo '<a href="resetpwemail" class="btn btn-primary">Reset com Email</a><br />';
                                                }
                                                else {
                                                    echo '<a data-toggle="tooltip" data-title="Esta função foi desabilitada pelo seu administrador.." class="btn btn-primary disabled">Reset com Email</a><br />';
                                                }
                                            }
                                        ?>
                                    </p>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </fieldset>
        </form>
    </div>
</div>
<!-- Content Ends -->
</body>
</html>