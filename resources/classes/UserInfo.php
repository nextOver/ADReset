<?php
    require_once(__DIR__ . '/../core/init.php');

    Class UserInfo {

        private $db_connection = null;

        public function __construct() {
            // Make sure the database can connect
            if (!$this->db_connection = startPDOConnection()) {
                echo '<h2 style="text-align:center">Database Connection Error:</h2><h3 style="text-align:center">Please contact the Help Desk with this error.</h3>';
                die();
            }
        }

        public function __destruct() {
            $this->db_connection = null;
        }

        protected function setErrorAndQuit($message) {
            if (isset($message)) {
                FlashMessage::flash('ChangeProfileError', $message);
                header('Location: /settings/localusersettings');
                exit();
            }
        }

        public function get($user_username = ''){
            if (empty($user_username)) {
                if (isset($_SESSION['user_name'])) {
                    $user_username = isset($_SESSION['user_name']);
                }
                else {
                    return array();
                }
            }

            if (isset($_SESSION['user_name']) && $this->db_connection) {
                $user_username = $_SESSION['user_name'];
                $stmt = $this->db_connection->prepare('SELECT username, email, name, created FROM localusers WHERE username = ?');
                
                if ($stmt->execute(array($user_username))) {
                    // If this user exists return the results
                    if ($stmt->rowCount() == 1) {
                        $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
                        //Close the connection
                        $stmt = null;
                        return $userInfo;
                    }
                    else {
                        return array();
                    }
                }
            }
            else {
                return array();
            }
        }

        public function setProfile($user_username = '') {
            if (empty($user_username)) {
                if (isset($_SESSION['user_name'])) {
                    $user_username = isset($_SESSION['user_name']);
                }
                else {
                    return false;
                }
            }

            if ($this->db_connection) {
                $user_newusername = trim($_POST['user_newusername']);
                $user_name = trim($_POST['user_newname']);
                $user_email = trim($_POST['user_newemail']);

                if ($this->get($user_username)['username'] != $user_newusername){
                    $stmt = $this->db_connection->prepare('SELECT username FROM localusers WHERE username = ?');
                    
                    if($stmt->execute(array($user_newusername))) {
                        // if this username is already taken
                        if ($stmt->rowCount() != 0) {
                            //Close the connections
                            $stmt = null;
                            FlashMessage::flash('ChangeProfileError', 'Este nome de usuário já está em uso.');
                            header('Location: /settings/localusersettings');
                            exit();
                        }
                    }
                    $stmt = null;
                }
                
                if ($this->get($user_username)['email'] != $user_email){
                    $stmt = $this->db_connection->prepare('SELECT email FROM localusers WHERE email = ?');
                    
                    if ($stmt->execute(array($user_email))) {
                        // if this username is already taken
                        if ($stmt->rowCount() != 0) {
                            //Close the connections
                            $stmt = null;
                            $this->setErrorAndQuit('Este e-mail de usuário já está em uso.');
                        }
                    }
                    $stmt = null;
                }

                if (strlen($user_newusername) > 64 || strlen($user_newusername) < 2) {
                    $this->setErrorAndQuit('A senha não está de acordo com a política de senha.<br />'. passwordPolicyWritten());
                }
                elseif (!preg_match('/^[a-zA-Z0-9]*[_.-]?[a-zA-Z0-9]*$/', $user_newusername)) {
                    $this->setErrorAndQuit('O nome de usuário não corresponde ao esquema de nomenclatura. Apenas letras, números, sublinhados e pontos são permitidos');
                }
                elseif (empty($user_email)) {
                    $this->setErrorAndQuit('Email não pode ser vazio');
                }
                elseif (strlen($user_email) > 64) {
                    $this->setErrorAndQuit('Email não pode ter mais de 64 caracteres.');
                }
                elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                    $this->setErrorAndQuit('Este email não possui um formato válido');
                }
                elseif (!empty($user_newusername)
                    && strlen($user_newusername) <= 64
                    && strlen($user_newusername) >= 2
                    && preg_match('/^[a-zA-Z0-9]*[_.-]?[a-zA-Z0-9]*$/', $user_newusername)
                    && !empty($user_email)
                    && strlen($user_email) <= 64
                    && filter_var($user_email, FILTER_VALIDATE_EMAIL)
                ) {
                    $user_name = $_POST['user_newname'];
                    $user_email = $_POST['user_newemail'];
                    $stmt = $this->db_connection->prepare('UPDATE localusers SET username = ?, name = ?, email = ? WHERE username = ?');
                    
                    if ($stmt->execute(array($user_newusername, $user_name, $user_email, $user_username))) {
                        $_SESSION['user_name'] = $user_newusername;
                        Logger::log('audit', 'Local Admin Profile Change Success: Profile of User "' . $user_username . '" was set to User "' . $user_newusername . '", Name "' . $user_name . '", Email "' . $user_email . '"');
                        FlashMessage::flash('ChangeProfileMessage', 'O perfil foi alterado com sucesso.');
                        header('Location: /settings/localusersettings');
                        exit();
                    }
                    else {
                        $this->setErrorAndQuit('Perfil não pôde ser modificado.');
                    }
                }
            }
            else {
                $this->setErrorAndQuit('Ocorreu um problema ao conectar ao banco de dados. Por favor, tente novamente.');
            }
        }

    }
