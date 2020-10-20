<?php
    require_once('../resources/core/init.php');

    if (LoginCheck::isLoggedIn()) {
        header("Location: /index");
        exit();
    }
    else {
        if (isset($_GET['username'])) {
            // Make sure ADReset can connect to Active Directory
            try {
                $AD = new AD();
            }
            catch (Exception $e) {
                FlashMessage::flash('ResetPWError', sanitize($e->getMessage()));
                header("Location: /resetpw");
                exit();
            }

            //Check to make sure there haven't been more than 5 failed attempts
            $systemSettings = new SystemSettings();
            $resetPW = new ResetPW();
            if ($failedAttemptsAllowed = $systemSettings->getOtherSetting('failedattemptsallowed')) {
                if ($resetPW->getNumberOfFailedAttempts($_GET['username']) >= intval($failedAttemptsAllowed)) {
                    FlashMessage::flash('ResetPWError', 'Você não conseguiu verificar suas perguntas secretas muitas vezes e sua conta está bloqueada. Entre em contato com o Help Desk para obter assistência');
                    header("Location: /resetpw");
                    exit();
                }
            }
            else {
                FlashMessage::flash('ResetPWError', 'Ocorreu um erro no banco de dados. Por favor, tente novamente.');
                header("Location: /resetpw");
                exit();
            }

            // Make sure the user has three questions set
            $userSettings = new UserSettings();
            try {
                if ($userSettings->numSecretQuestionsSetToUser(urldecode($_GET['username'])) < 3) {
                    FlashMessage::flash('ResetPWError', 'Você não pode usar este recurso porque não tem suas perguntas secretas definidas.');
                    header("Location: /resetpw");
                    exit();
                }
            }
            catch (Exception $e) {
                FlashMessage::flash('ResetPWError', 'Ocorreu um erro no banco de dados. Por favor, tente novamente.');
                header("Location: /resetpw");
                exit();
            }

            // Make sure the user is allowed to reset their password
            if ($resetPW->isUserAllowedToReset(urldecode($_GET['username']), $AD)) {
                require_once(RESOURCE_DIR . '/views/verify_questions.php');
            }
            else {
                FlashMessage::flash('ResetPWError', 'Você não tem permissão para usar este recurso. Entre em contato com o Help Desk para obter assistência.');
                header("Location: /resetpw");
                exit();
            }
            
        }
        elseif (isset($_POST['verifySecretQuestions'])) {
            if (isset($_POST['secretQuestion1'], $_POST['secretQuestion2'], $_POST['secretQuestion3'], $_POST['secretAnswer1'], $_POST['secretAnswer2'], $_POST['secretAnswer3'], $_POST['username'])) {
                $userSettings = new UserSettings();

                // Make sure ADReset can connect to Active Directory
                try {
                    $AD = new AD();
                }
                catch (Exception $e) {
                    FlashMessage::flash('ResetPWError', sanitize($e->getMessage()));
                    header("Location: /resetpw");
                    exit();
                }

                $resetPW = new ResetPW();
                // Make sure the user is allowed to reset their password
                if (!$resetPW->isUserAllowedToReset($_POST['username'], $AD)) {
                    FlashMessage::flash('ResetPWError', 'Você não tem permissão para usar este recurso. Entre em contato com o Help Desk para obter assistência.');
                    header("Location: /resetpw");
                    exit();
                }

                //Check to make sure there haven't been more than 5 failed attempts
                $systemSettings = new systemSettings();
                if ($failedAttemptsAllowed = $systemSettings->getOtherSetting('failedattemptsallowed')) {
                    if ($resetPW->getNumberOfFailedAttempts($_GET['username']) >= intval($failedAttemptsAllowed)) {
                        FlashMessage::flash('ResetPWError', 'Você não conseguiu verificar suas perguntas secretas muitas vezes e sua conta está bloqueada. Entre em contato com o Help Desk para obter assistência.');
                        header("Location: /resetpw");
                        exit();
                    }
                }
                else {
                    FlashMessage::flash('ResetPWError', 'Ocorreu um erro no banco de dados. Por favor, tente novamente.');
                    header("Location: /resetpw");
                    exit();
                }

                if ($resetPW->getNumberOfFailedAttempts($_POST['username']) >= 5) {
                    FlashMessage::flash('ResetPWError', 'Você não conseguiu verificar suas perguntas secretas muitas vezes e sua conta está bloqueada. Entre em contato com o Help Desk para obter assistência.');
                    header("Location: /resetpw");
                    exit();
                }

                // Verify the questions and set a temporary code if successful
                if (!empty($_POST['secretQuestion1']) && !empty($_POST['secretQuestion2']) && !empty($_POST['secretQuestion3']) && !empty($_POST['secretAnswer1']) && !empty($_POST['secretAnswer2']) && !empty($_POST['secretAnswer3']) && !empty($_POST['username'])) {
                    $userSettings = new UserSettings();
                    if ($resetPW->verifySecretQuestionSetToUser($_POST['username'], $_POST['secretQuestion1'], $_POST['secretAnswer1']) && $resetPW->verifySecretQuestionSetToUser($_POST['username'], $_POST['secretQuestion2'], $_POST['secretAnswer2']) && $resetPW->verifySecretQuestionSetToUser($_POST['username'], $_POST['secretQuestion3'], $_POST['secretAnswer3'])) {
                        $resetPW = new ResetPW();
                        if ($generatedcode = $resetPW->generateQuestionsCode($_POST['username'])) {
                            header("Location: /newpw?idq=" . $generatedcode);
                            exit();
                        }
                    }

                    // Record the failed login in the database
                    $resetPW->setFailedAttempt($_POST['username']);
                    FlashMessage::flash('ResetPWError', 'As perguntas secretas fornecidas estavam incorretas. Por favor, tente novamente.');
                    header("Location: /resetpw");
                    exit();
                }
            }

        }
        else {
            header("Location: /resetpw");
            exit();
        }
    }
