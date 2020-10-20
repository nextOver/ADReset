<!DOCTYPE html>
<html lang="en">
<?php
$pageTitle = 'Configurações do usuário';
    require_once(__DIR__ . '/../templates/header.php');
?>
<body>
<!-- Navigation Menu Starts -->
<?php
    require_once(__DIR__ . '/../templates/navigation.php');
?>
<!-- Navigation Menu Ends -->
<script src="/js/resetSecretQuestionsPrompt.js"></script>
<!-- Content Starts -->
<div class="container" id="mainContentBody">
    <h2 class="topHeader">Configurações do usuário</h2>
    <h3>Bem vindo <?php echo ucwords($_SESSION['user_name']); ?>,</h3>
    <br />
    <div class="col-md-12">
        <?php
            // Show potential feedback from the settings changes object
            if (FlashMessage::flashIsSet('ChangeUserSettingsError')) {
                FlashMessage::displayFlash('ChangeUserSettingsError', 'error');
            }
            elseif (FlashMessage::flashIsSet('ChangeUserSettingsMessage')) {
                FlashMessage::displayFlash('ChangeUserSettingsMessage', 'message');
            }
            elseif (($numSecretQuestionsSet = $userSettings->numSecretQuestionsSetToUser($_SESSION['user_name'])) < 3) {
        ?>
        <div class="col-md-12">
            <div class="alert alert-info infoBlurb" role="alert">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <p>Definir suas perguntas secretas permitirá que você redefina sua senha do Windows (Active Directory) sem a ajuda do Help Desk.</p>
                <p>Três perguntas secretas devem ser definidas antes que este recurso possa ser utilizado. Você tem <?php echo $numSecretQuestionsSet; ?> de 3 respostas configuradas.</p>
            </div>
        </div>
        <?php
                $numSecretQuestionsSet = null;
            }
        ?>
    </div>
    <h4>O que você gostaria de mudar?</h4>
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        Configurações do usuário
                    </h4>
                </div>
                <div id="collapse4" class="panel-collapse ">
                    <div class="panel-body">
                        <p class="systemSettingsSubheader">
                            <a href="#" class="tool-tip" data-toggle="tooltip" data-placement="top" data-original-title="Abaixo você pode preencher suas perguntas e respostas secretas. Depois que todos os três estiverem definidos, você poderá redefinir sua senha do Windows (Active Directory) usando-as.">Gerencie suas perguntas secretas abaixo:</a>
                        </p>
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead><tr>
                                <th class="center">Perguntas secretas:</th>
                                <th class="center">Respostas secretas:</th>
                                <th class="center">Ações</th>
                            </tr></thead>
                            <tbody>
                            <?php
                                $usersQuestions = $userSettings->getSecretQuestionsSetToUser($_SESSION['user_name']);
                                foreach ($usersQuestions as $question) {
                                    echo '<tr>
                                        <form class="btn-link-form" method="post" action="usersettings.php" name="editSecretAnswer">
                                        <td class="center width-forty" style="min-width:150px">', $question, '</td>
                                        <td class="width-fifty" style="min-width:150px"><input type="password" class="form-control" placeholder="Insira sua resposta secreta" name="secretAnswer"></td>
                                        <td class="center"><input type="submit" class="btn btn-link center" name="editSecretAnswer" value="Atualizar"></td>
                                        <input type="hidden" name="secretQuestion" value="' . $question . '">
                                        </form>
                                    </tr>';
                                }

                                $numSecretQuestionsSet = $userSettings->numSecretQuestionsSetToUser($_SESSION['user_name']); 
                                if ($numSecretQuestionsSet < 3) {
                                    for ($i = $numSecretQuestionsSet; $i < 3; $i++) {
                                        echo '<tr>
                                            <form class="btn-link-form" method="post" action="usersettings.php" name="addSecretAnswer">
                                            <td class="width-forty" style="min-width:150px">';

                                        $secretQuestions = $userSettings->getUniqueSecretQuestionsForUser($_SESSION['user_name']);

                                        echo '<select class="form-control secretQuestionSelect" name="secretQuestion">';

                                        foreach ($secretQuestions as $secretQuestion) {
                                            echo '<option>' . $secretQuestion . '</option>';
                                        }
                                        echo '</select>';
                                        
                                        // Allow input on the next quesiton needed to be filled
                                        if ($i == $numSecretQuestionsSet) {
                                            echo '</td>
                                                <td class="width-fifty" style="min-width:150px"><input type="password" class="form-control" placeholder="Insira sua resposta secreta" name="secretAnswer"></td>
                                                <td class="center"><input type="submit" class="btn btn-link" name="addSecretAnswer" value="Add"></td>
                                                </form>
                                            </tr>';
                                        }
                                        // Disable the input for subsequent questions
                                        else {
                                            echo '</td>
                                                <td class="width-fifty" style="min-width:150px"><input type="password" class="form-control" placeholder="Insira sua resposta secreta" name="secretAnswer" disabled></td>
                                                <td class="center"><input type="submit" class="btn btn-link" name="addSecretAnswer" value="Add" disabled></td>
                                                </form>
                                            </tr>';
                                        }
                                        
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                        </div>
                    </div>

                    <form method="post" action="usersettings.php" id="resetSecretQuestions" name="resetSecretQuestions">
                        <input type="button" class="btn btn-danger resetQuestionsBtn" name="resetSecretQuestions" value="Apagar respostas">
                        <input type="hidden" name="resetSecretQuestions" value="Reset Questions">
                    </form>
                </div>
            </div>
      </div> 
</div>
<!-- Content Ends -->
</body>
</html>