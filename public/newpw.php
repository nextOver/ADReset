<?php
    require_once('../resources/core/init.php');

    if (LoginCheck::isLoggedIn()) {
        header("location: index.php");
        exit();
    }
    else {
        // If $_GET['id'] is set, that means the user clicked the email
        if (isset($_GET['id'])) {
            $resetPW = new ResetPW();
            if (!$resetPW->isCodeValidFromEmail()) {
                // If the code is invalid, return the user to index.php
                header('Location: /index');
                exit();
            }

            require_once(RESOURCE_DIR . '/views/new_pw.php');
        }
        elseif (isset($_GET['idq'])) {
            $resetPW = new ResetPW();
            if (!$resetPW->isQuestionsCodeValid($_GET['idq'])) {
                // If the code is invalid, return the user to index.php
                FlashMessage::flash('InvalidCodeError', '/js/invalidCodePrompt.js');
                header('Location: /index');
                exit();
            }

            require_once(RESOURCE_DIR . '/views/new_pw.php');
        }
        // If $_POST['id'] is set, that means the user submitted the new password and the hidden input with the code id was submitted with the form
        elseif (isset($_POST['id'])) {
            $resetPW = new ResetPW();
            if ($resetPW->isCodeValidFromEmail()) {
                if (isset($_POST['setPassword'])) {
                    if ($resetPW->setNewPassword()) {
                        FlashMessage::flash('passwordSetMessage', '/js/passwordResetSuccess.js');
                        header('Location: /index');
                        exit();
                    }
                    else {
                        header('Location: /newpw?id=' . $_POST['id']);
                        exit();
                    }
                }
            }
            else {
                // If the code is invalid, return the user to index.php
                header('Location: /index');
                exit();
            }
        }
        elseif (isset($_POST['idq'])) {
            $resetPW = new ResetPW();
            if ($resetPW->isQuestionsCodeValid()) {
                if (isset($_POST['setPassword'])) {
                    if ($resetPW->setNewPassword()) {
                        FlashMessage::flash('passwordSetMessage', '/js/passwordResetSuccess.js');
                        header('Location: /index');
                        exit();
                    }
                    else {
                        header('Location: /newpw?idq=' . $_POST['id']);
                        exit();
                    }
                }
            }
            else {
                // If the code is invalid, return the user to index.php
                header('Location: /index');
                exit();
            }
        }
        else {
            header("Location: /index");
            exit();
        }

        
    }

?>