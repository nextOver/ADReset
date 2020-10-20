<?php 
    require_once(__DIR__ . '/../core/init.php');
    $systemSettings = new SystemSettings;
    $isEmailResetEnabled = $systemSettings->getOtherSetting('emailresetenabled');
    if (isset($isEmailResetEnabled) && $isEmailResetEnabled == 'true') {
        echo '<script src="/js/resetPrompt.js"></script>';
    }
?>

<nav role="navigation" class="navbar navbar-default navbar-static-top">
    <div class="container">
        <!-- The brand and the toggle bar (to collapse the menu) -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
             <!-- Logo designed and made by Mandy Patterson -->
            <a href="/index" class="navbar-brand"><img src="/img/ADReset.png" /></a>
        </div>
        <!-- Navigation links for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <!-- Right links on the navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/index">Início</a></li>
                <li><a href="/account">Configurar perguntas secretas</a></li>
            <?php
                if (isset($isEmailResetEnabled) && $isEmailResetEnabled == 'true') {
                    echo '<li><a href="/resetpwemail" id="resetpw">Esqueci a senha</a></li>';
                }
                else {
                    echo '<li><a href="/resetpw" id="resetpw">Esqueci a senha</a></li>';
                }
            ?>
                <li><a href="/changepw">Alterar senha</a></li>
                <li><a href="/account">Login</a></li>
            </ul>
        </div>
    </div>
</nav>