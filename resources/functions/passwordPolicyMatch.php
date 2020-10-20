<?php
    require_once(__DIR__ . '/../core/init.php');
    function passwordPolicyMatch($password) {
        if (isset($password)){
            if (strlen($password) >= Config::get('security/passwordLength')) {
                return true;
            }
        }

        return false;
    }

    function passwordPolicyWritten() {
        return 'A senha precisa ter' . Config::get('security/passwordLength') . ' ou mais caracteres.';
    }
