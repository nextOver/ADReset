<!DOCTYPE html>
<html lang="en">
<?php
$pageTitle = 'System Settings';
    require_once(__DIR__ . '/../templates/header.php');
?>
<body>
<script src="/js/systemSettings.js"></script>
<!-- Navigation Menu Starts -->
<?php
    if (LoginCheck::isLocal()) {
        require_once(__DIR__ . '/../templates/local_navigation.php');
    }
    else {
        require_once(__DIR__ . '/../templates/admin_navigation.php');
    }
?>
<!-- Navigation Menu Ends -->
<!-- Content Starts -->
<div class="container" id="mainContentBody">
    <h2 class="topHeader">Configurações do sistema</h2>
    <h3>Bem vindo <?php echo ucwords($_SESSION['user_name']); ?>,</h3>
    <br />
    <div class="col-md-12">
        <?php
            // Show potential feedback from the settings changes object
            if (FlashMessage::flashIsSet('SystemSettingsError')) {
                FlashMessage::displayFlash('SystemSettingsError', 'error');
            }
            elseif (FlashMessage::flashIsSet('SystemSettingsMessage')) {
                FlashMessage::displayFlash('SystemSettingsMessage', 'message');
            }
        ?>
    </div>
    <h4>O que você gostaria de alterar?</h4>
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                            Grupos de segurança administrativos</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p class="systemSettingsSubheader">
                            <a href="#" class="tool-tip" data-toggle="tooltip" data-placement="top" data-original-title="Esses são os grupos que têm acesso administrativo ao ADReset. Os nomes dos grupos abaixo são os atributos SAMAccountName dos grupos. Isso é chamado de &quot; Nome do grupo (pré-Windows 2000) &quot; em Usuários e computadores do AD">Veja os grupos administrativos abaixo:</a>
                        </p>
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <theader><tr>
                                <th><a href="#" class="tool-tip" data-toggle="tooltip" data-placement="top" data-original-title="The group names below are the SAMAccountName attributes of the groups. This is called &quot;Group name (pre-Windows 2000)&quot; in AD Users and Computers.">Nome dos grupos:</a></th>
                                <th>Ação:</th>
                            </tr></theader>
                            <tbody>
                            <?php
                                $groups = $systemSettings->getAdminGroups();
                                foreach ($groups as $group)
                                {
                                    if (isset($group['samaccountname']))
                                    {
                            ?>
                                        <tr>
                                            <td><?php echo $group['samaccountname']; ?></td>
                                            <td><form class="btn-link-form deleteAdminGroup" method="post" action="systemsettings.php" name="deleteAdminGroup">
                                                <input type="hidden" value=<?php echo '"', $group['samaccountname'], '"'; ?> name="groupname">
                                                <input type="hidden" value=<?php echo '"', $group['guid'], '"'; ?> name="groupguid">
                                                <input type="hidden" value="Delete" name="deleteAdminGroup">
                                                <input type="button" class="btn btn-link" value="Delete">
                                            </form></td>
                                        </tr>
                            <?php
                                    }
                                    elseif (isset($group['guid']))
                                    {
                            ?>
                                        <tr>
                                            <td><?php echo $group['guid']; ?></td>
                                            <td><form class="btn-link-form deleteAdminGroup" method="post" action="systemsettings.php" name="deleteAdminGroup">
                                                <input type="hidden" value=<?php echo '"', $group['guid'], '"';?> name="groupguid">
                                                <input type="hidden" value="Delete" name="deleteAdminGroup">
                                                <input type="button" class="btn btn-link" value="Delete">
                                            </form></td>
                                        </tr>
                            <?php
                                    }
                                    
                                }
                            ?>
                            <tr>
                                <td><form class="btn-link-form" method="post" action="systemsettings.php" name="addAdminGroup">
                                    <input type="text" class="form-control addGroupInput" placeholder="Enter the group name" name="groupname">
                                </td>
                                <td>
                                    <input type="submit" class="btn btn-link addGroupBtn" name="addAdminGroup" value="Add">
                                </form></td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Redefinir grupos de segurança</a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p class="systemSettingsSubheader">
                            <a href="#" class="tool-tip" data-toggle="tooltip" data-placement="top" data-original-title="Esses são os grupos que têm permissão para usar ADReset para redefinir suas senhas. Os nomes dos grupos abaixo são os atributos SAMAccountName dos grupos. Isso é chamado de &quot; Nome do grupo (pré-Windows 2000) &quot; em usuários e computadores AD">Veja os grupos capazes de redefinir senhas::</a>
                        </p>
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <theader><tr>
                                <th><a href="#" class="tool-tip" data-toggle="tooltip" data-placement="top" data-original-title="Os nomes dos grupos abaixo são os atributos SAMAccountName dos grupos. Isso é chamado de &quot; Nome do grupo (pré-Windows 2000) &quot; em Usuários e computadores do AD">Nome dos grupos:</a></th>
                                <th>Action:</th>
                            </tr></theader>
                            <tbody>
                            <?php
                                $groups = $systemSettings->getResetGroups();
                                foreach ($groups as $group)
                                {
                                    if (isset($group['samaccountname']))
                                    {
                            ?>
                                        <tr>
                                            <td><?php echo $group['samaccountname']; ?></td>
                                            <td><form class="btn-link-form deleteResetGroup" method="post" action="systemsettings.php" name="deleteResetGroup">
                                                <input type="hidden" value=<?php echo '"', $group['samaccountname'] , '"'; ?> name="groupname">
                                                <input type="hidden" value=<?php echo '"', $group['guid'], '"'; ?> name="groupguid">
                                                <input type="hidden" value="Delete" name="deleteResetGroup">
                                                <input type="button" class="btn btn-link" value="Delete">
                                            </form></td>
                                        </tr>
                            <?php   
                                    }
                                    elseif (isset($group['guid'])) {
                            ?>
                                        <tr>
                                            <td><?php echo $group['guid']; ?></td>
                                            <td><form class="btn-link-form deleteResetGroup" method="post" action="systemsettings.php" name="deleteResetGroup">
                                                <input type="hidden" value=<?php echo '"', $group['guid'],'"' ?> name="groupguid">
                                                <input type="hidden" value="Delete" name="deleteResetGroup">
                                                <input type="button" class="btn btn-link" value="Delete">
                                            </form></td>
                                        </tr>
                            <?php
                                    }
                                    
                                }
                            ?>
                            <tr>
                                <td><form class="btn-link-form" method="post" action="systemsettings.php" name="addResetGroup">
                                    <input type="text" class="form-control addGroupInput" placeholder="Enter the group name" name="groupname">
                                </td>
                                <td>
                                    <input type="submit" class="btn btn-link addGroupBtn" name="addResetGroup" value="Add">
                                </form></td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Configuração de conexão com e-mail</a>
                    </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p class="systemSettingsSubheader">
                            
                            Insira as configurações de e-mail para enviar notificações

                        </p>
                        <form class="form-horizontal" method="post" action="/settings/systemsettings.php" name="updateEmailSettings">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputFromEmail" class="col-lg-2 control-label">
                                Email de origem:</label>
                                <div class="col-lg-10">
                                    <input type="email" class="form-control" id="inputFromEmail" placeholder="From Email Address" name="email_fromEmail" value="<?php if (isset($emailSettings['fromEmail'])) { echo sanitize($emailSettings['fromEmail']); } ?>" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputFromName" class="col-lg-2 control-label">Nome:</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputFromName" placeholder="From Name" name="email_fromName" value="<?php if (isset($emailSettings['fromName'])) { echo sanitize($emailSettings['fromName']); } ?>" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputUsername" class="col-lg-2 control-label">Nome de usuário</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputUsername" placeholder="Username" name="email_username" value="<?php if (isset($emailSettings['username'])) { echo sanitize($emailSettings['username']); } ?>" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword" class="col-lg-2 control-label">Senha:</label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="email_password" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputServer" class="col-lg-2 control-label">Servidor:</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputServer" placeholder="Mail Server DNS Name" name="email_server" value="<?php if (isset($emailSettings['server'])) { echo sanitize($emailSettings['server']); } ?>" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPort" class="col-lg-2 control-label">Porta:</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputPort" placeholder="Mail Server Port" name="email_port" value="<?php if (isset($emailSettings['port'])) { echo sanitize($emailSettings['port']); } ?>" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Encriptação:</label>
                                <div class="col-lg-10">
                                      <select class="form-control" name="email_encryption">
                                        <?php
                                            if (isset($emailSettings['encryption'])) {
                                                // This will output the current option at the top
                                                switch($emailSettings['encryption']) {
                                                    case ('SSL'):
                                                        echo '<option>SSL</option>
                                                              <option>TLS</option>
                                                              <option>Nenhum</option>';
                                                        break;
                                                    case ('None'):
                                                        echo '<option>Nenhum</option>
                                                              <option>TLS</option>
                                                              <option>SSL</option>';
                                                        break;
                                                    // If its TLS or anything else, just default it to TLS at the top
                                                    default:
                                                        echo '<option>TLS</option>
                                                              <option>SSL</option>
                                                              <option>Nenhum</option>';
                                                        break;
                                                }
                                            }
                                            else {
                                                echo '<option>TLS</option>
                                                      <option>SSL</option>
                                                      <option>Nenhum</option>';
                                            }
                                        ?>
                                      </select>
                                </div>
                            </div>
                            <br />
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="submit" class="btn btn-primary" name="changeEmailSettings" value="Change Email Settings">Atualiar</button>
                                    
                                </div>
                            </div>
                        </fieldset>
                        </form>
                        <br /><br />
                        <form class="form-horizontal" id="testEmailSettings" method="post" action="/ajax/testemailsettings.php" name="sendTestEmail">
                        <fieldset>
                            <p class="systemSettingsSubheader">
                                
                                Envie um e-mail de teste com suas configurações salvas:
                            </p>
                            <div class="form-group">
                                <label for="inputToEmailTest" class="col-lg-2 control-label">Send To:</label>
                                <div class="col-lg-10">
                                    <input type="email" class="form-control" id="inputToEmailTest" placeholder="Send Test Email To" name="email_testemailto" autocomplete="off" required>
                                </div>
                            </div>
                            <br />
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="submit" class="btn btn-primary" name="sendTestEmail" data-loading-text="Enviando...">Enviar</button>
                                    <button class="btn btn-default" type="reset">Reset</button>
                                </div>
                            </div>
                        </fieldset>
                        </form>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Perguntas secretas</a>
                    </h4>
                </div>
                <div id="collapse4" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p class="systemSettingsSubheader">
                            <a href="#" class="tool-tip" data-toggle="tooltip" data-placement="top" data-original-title="A minimum of three secret questions must be set before users may set their secret questions and answers. If you choose to disable a secret question, current users using that question will still be able to use it but new users will not be able to use the disabled secret question.">Gerenciar perguntas secretas:</a>
                        </p>
                        <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <theader><tr>
                                <th>Pergunta secreta:</th>
                                <th>Ação:</th>
                            </tr></theader>
                            <tbody>
                            <?php
                                if ($questions = $systemSettings->getSecretQuestions())
                                {

                                
                                        foreach ($questions as $question)
                                    {
                            ?>
                            <tr>
                                <td> <?php echo sanitize($question['secretquestion']); ?> </td>
                                <td>
                    <form class="btn-link-form changeSecretQuestion" method="post" action="systemsettings.php" name="changeSecretQuestion">
<input type="hidden" value=<?php echo '"', sanitize($question['secretquestion']), '"' ?> name="secretQuestion">
                    <input type="hidden" value="Change" name="changeSecretQuestion">

                                    <?php 
                                        if ($question['enabled']) {
                                            echo '<input type="button" class="btn btn-link" value="Disable">';
                                        }
                                        else {
                                            echo '<input type="button" class="btn btn-link" value="Enable">';
                                        }
                                    ?>
                                    
                            </form>

                    <form class="btn-link-form" method="post" action="systemsettings.php" name="deleteSecretQuestion">
                    <input type="hidden" value=<?php echo '"', sanitize($question['secretquestion']), '"' ?> name="secretQuestion">
                    <input type="hidden" value="Delete" name="deleteSecretQuestion">

                        <input type="submit" class="btn btn-link" value="Remove">
                    </form>
                                </td>
                            </tr>                           
                            
                            <?php
                                    }
                                } 
                            ?>
                            <tr>
                                <td><form class="btn-link-form" method="post" action="systemsettings.php" name="addSecretQuestion">
                                    <input type="text" class="form-control addSecretQuestion" placeholder="Insira uma nova pergunta secreta" name="secretquestion" required="yes">
                                </td>
                                <td>
                                    <input type="submit" class="btn btn-link addSecretQuestionBtn" name="addSecretQuestion" value="Adicionar">
                                </form></td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Outras configurações</a>
                    </h4>
                </div>
                <div id="collapse5" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p class="systemSettingsSubheader">
                            Outras configurações:
                        </p>
                        <form class="form-horizontal" method="post" action="/settings/systemsettings.php" name="updateOtherSettings">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputEmailTemplate" class="col-lg-2 control-label"><a href="#" class="tool-tip" data-toggle="tooltip" data-placement="top" data-original-title="This template supports two variables, [user-name] and [reset-link]. Place them anywhere in the template and they will be replaced by the proper values.">Template de e-mail:</a></label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" rows="7" id="inputEmailTemplate" placeholder="Password Reset Email Template" name="email_emailTemplate" required><?php
                                        if (isset($systemSettings) && $resetEmailBody = $systemSettings->getOtherSetting('resetemailbody')) {
                                            echo sanitize($resetEmailBody);
                                        }
                                    ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label"><a href="#" class="tool-tip" data-toggle="tooltip" data-placement="top" data-original-title="Ao desabilitar isso, os usuários não poderão mais redefinir suas senhas usando e-mails secundários.">Resetar senha com e-mail:</a></label>
                                <div class="col-lg-10">
                                    <div class="radio">
                                      <label>
                                        <input type="radio" name="options_EnableEmailReset" value="true" <?php if ($systemSettings->getOtherSetting('emailresetenabled ') == 'true') { echo 'checked="checked"'; } ?> >
                                        habilitado
                                      </label>
                                    </div>
                                    <div class="radio">
                                      <label>
                                        <input type="radio" name="options_EnableEmailReset" value="false" <?php if ($systemSettings->getOtherSetting('emailresetenabled ') != 'true') { echo 'checked="checked"'; } ?>>
                                        Desabilitado
                                      </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label id="inputEmailLDAPAttribute" class="col-lg-2 control-label"><a href="#" class="tool-tip" data-toggle="tooltip" data-placement="top" data-original-title="Este é o atributo LDAP em objetos de usuário que especifica o endereço de e-mail a ser usado ao enviar e-mails de recuperação de senha. O atributo padrão é &quot; mail &quot;.."> Atributo de Email LDAP:</a></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputEmailLDAPAttribute" name="email_ldapattribute" placeholder="Atributo de Email LDAP" value="<?php echo $systemSettings->getOtherSetting('emailldapattribute'); ?>" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label"><a href="#" class="tool-tip" data-toggle="tooltip" data-placement="top" data-original-title="Isso especifica quantas tentativas malsucedidas são permitidas para responder a perguntas secretas em um período de 15 minutos.">Tentativas de redefinição sem sucesso permitidas:</a></label>
                                <div class="col-lg-10">
                                      <select class="form-control" name="questions_failedattemptsallowed">
                                            <?php
                                                if (isset($systemSettings) && $failedAttemptsAllowed = $systemSettings->getOtherSetting('failedattemptsallowed')) {
                                                    echo '<option>', $failedAttemptsAllowed , '</option>';
                                                }
                                            ?>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                            <option>6</option>
                                            <option>7</option>
                                            <option>8</option>
                                            <option>9</option>
                                            <option>10</option>
                                      </select>
                                </div>
                            </div>
                            <br />
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="submit" class="btn btn-primary" name="updateOtherSettings" value="Update Other Settings">Atualizar</button>
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