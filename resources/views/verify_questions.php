<!DOCTYPE html>
<html lang="en">
<?php
$pageTitle = 'Verify Secret Questions';
    require_once(__DIR__ . '/../templates/header.php');
?>
<body>
<!-- Navigation Menu Starts -->
<?php
    require_once(__DIR__ . '/../templates/not_loggedin_navigation.php');
?>
<!-- Navigation Menu Ends -->
<!-- Content Starts -->
<div class="container" id="mainContentBody">
    <h2 class="topHeader">Verifique suas perguntas secretas</h2>
    <br />
    <div class="col-md-12">
        <?php
            // Show potential feedback from the settings changes object
            if (FlashMessage::flashIsSet('VerifyQuestionsError')) {
                FlashMessage::displayFlash('VerifyQuestionsError', 'error');
            }
            elseif (FlashMessage::flashIsSet('VerifyQuestionsMessage')) {
                FlashMessage::displayFlash('VerifyQuestionsMessage', 'message');
            }
        ?>
    </div>
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">                        
                            Verificação de pergunta secreta
                    </h4>
                </div>
                <div id="collapse4" class="panel-collapse ">
                    <div class="panel-body">
                        <p class="verifyQuestionsSubheader">
                            Digite suas perguntas secretas abaixo:
                        </p>
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead><tr>
                                <th class="center">pergunta secreta:</th>
                                <th class="center">Resposta secreta:</th>
                            </tr></thead>
                            <tbody>
                            <form class="btn-link-form" method="post" action="verifyquestions.php" name="verifySecretQuestions">
                            <?php
                                $usersQuestions = $userSettings->getSecretQuestionsSetToUser($_GET['username']);
                                $i = 1;
                                foreach ($usersQuestions as $question) {
                            ?>
                                    <tr>
                                        <td class="center width-forty" style="min-width:150px"><?php echo $question; ?></td>
                                        <td class="width-fifty" style="min-width:150px"><input type="password" class="form-control" placeholder="Insira sua resposta secreta" required="yes" name=<?php echo '"secretAnswer' . $i . '"' ?>></td>
                                        <input type="hidden" name=<?php echo '"secretQuestion' . $i . '"' ?> value=<?php echo '"', $question, '"'; ?>>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            ?>
                            </tbody>
                        </table>
                                <br />
                                <div class="form-group">
                                  <div class="col-lg-11 col-lg-offset-1">
                                    <input type="hidden" value=<?php echo urldecode($_GET['username']); ?> name="username">
                                    <button type="submit" class="btn btn-primary" name="verifySecretQuestions" value="Submit">Confirmar</button>
                                    
                                  </div>
                                </div>
                                <br />
                        </form>
                        </div>
                    </div>
                </div>
            </div>
      </div> 
</div>
<!-- Content Ends -->
</body>
</html>