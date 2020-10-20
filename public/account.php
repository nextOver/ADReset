<?php
    require_once('../resources/core/init.php');

    $login = new ADLogin();
    $systemSettings = new SystemSettings();
    if (LoginCheck::isLoggedInAsAdmin()) {
       header('Location: /settings/systemsettings');

    } 
    elseif ($systemSettings->getNumOfSecretQuestions() < 3) {
        FlashMessage::flash('LoginError', 'O administrador não concluiu a configuração do sistema.<br />Por favor, tente novamente.');
        Logger::log('error', 'O usuário não pode fazer o login porque o mínimo de três perguntas secretas ainda não foram definidas');
        require_once(RESOURCE_DIR . "views/not_logged_in.php");
    }
    elseif (LoginCheck::isLoggedIn()) {
        header('Location: /settings/usersettings');
    } 
    else {
        require_once(RESOURCE_DIR . "views/not_logged_in.php");
    }