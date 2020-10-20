<?php
    require_once(__DIR__ . '/../core/init.php');
    require_once(RESOURCE_DIR . 'functions/ADPasswordPolicyMatch.php');

    Class ChangeADPassword {
        private $AD_connection;

        public function __construct() {
            try {
                $this->AD_connection = new AD();
            }
            catch (Exception $e) {
                $this->setErrorAndQuit('The Domain Controller could not be contacted.');
            }
        }

        private function setErrorAndQuit($message) {
            if (isset($message)) {
                FlashMessage::flash('ChangePWError', $message);
                header('Location: /changepw'); 
                exit();
            }

            return false;
        }

        public function changeFromPOST() {
            if (isset($_POST['user_name'], $_POST['user_password'], $_POST['user_new_password'], $_POST['user_confirm_password'], $_POST['user_captcha'])) {
                if (trim($_POST['user_captcha']) == $_SESSION['changepw_captcha']) {
                    if (trim($_POST['user_new_password']) == trim($_POST['user_confirm_password'])) {
                        if (ADPasswordPolicyMatch(trim($_POST['user_new_password']))) {
                            if ($this->AD_connection->changePassword(trim($_POST['user_name']), trim($_POST['user_password']), trim($_POST['user_new_password']))) {
                                Logger::log('audit', 'Password Change Success: The user "' . $_POST['user_name'] . '" changed their password.');
                                FlashMessage::flash('ChangePWMessage', 'Sua senha foi alterada com sucesso.');
                                header('Location: /changepw'); 
                                exit();
                            }
                            else {
                                Logger::log('audit', 'Password Change Failure: The user "' . $_POST['user_name'] . '" failed at changing their password.');
                                $this->setErrorAndQuit('Não foi possível alterar sua senha devido a uma senha incorreta. Se for um erro, entre em contato com o Help Desk');
                            }
                        }
                        else {
                            $this->setErrorAndQuit('Não foi possível alterar sua senha porque ela não atende aos requisitos de complexidade. ' . ADPasswordPolicyWritten());
                        }
                    }
                    else {
                        $this->setErrorAndQuit('Não foi possível alterar sua senha pois as duas entradas de sua nova senha não coincidem');
                    }
                }
                else {
                    $this->setErrorAndQuit('Não foi possível alterar sua senha porque o código de verificação não confere. Por favor, tente novamente');
                }
            }

            return false;
        }
    }
