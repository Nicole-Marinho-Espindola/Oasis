<?php

    function includeURL($path = '') {
        return sprintf(
            "%s/%s/%s",
            $_SERVER['DOCUMENT_ROOT'],
            'Oasis',
            $path
        );
    }

    include_once(includeURL('/config/database.php'));
    include_once(includeURL('/services/helpers.php'));

?>

<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'lib/vendor/autoload.php';

    //pegando o id
    if (isset($_GET['cd_voluntario'])) {
        $id = filter_input(INPUT_GET, 'cd_voluntario');
    
        try {
            $select = $conn->prepare("SELECT * FROM tb_voluntario WHERE cd_voluntario = :id");
            $select->bindParam(':id', $id);
    
            if ($select->execute()) {
                $row = $select->fetch(PDO::FETCH_ASSOC);
            } else {
                echo "Erro na consulta: " . $select->errorInfo()[2];
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "Não foi possível pegar o ID do voluntario.";
        exit();
    }

    if ($id->rowCount()) {

        $mail = new PHPMailer(true);

        try {
            //configurações do servidor, trocar pelas informações do servidor que a gente usar
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->CharSet = "UTF-8";
            $mail->isSMTP();
            $mail->Host       = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth   = true;
            $mail->Username   = '7e5019eaaeceaf';
            $mail->Password   = 'a77db86086ea94';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 2525;

            //Recipients
            $mail->setFrom('mairalinda@gmail.com.br', 'Maíra'); //substituir por um email de verdade
            $mail->addAddress('nm_email', 'nm_voluntario');

            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Confirma o e-mail';
            $mail->Body    = "Prezado(a) " . 'nm_voluntario' . ".<br><br>Agradecemos a sua solicitação de cadastramento 
            em nosso site!<br><br>Para que possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail 
            clicanco no link abaixo: <br><br> <a href='http://localhost/celke/confirmar-email.php?token_email=$token_email'>Clique aqui</a><br><br>
            Esta mensagem foi enviada a você pela empresa XXX.<br>Você está recebendo porque está cadastrado no banco de dados da empresa XXX.
            Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o preenchimento de senhas e informações cadastrais.<br><br>" ;

            $mail->AltBody = "Prezado(a) " . 'nm_voluntario' . ".\n\nAgradecemos a sua solicitação de cadastramento em nosso site!\n\nPara que
            possamos liberar o seu cadastro em nosso sistema, solicitamos a confirmação do e-mail clicanco no link abaixo: \n\n 
            http://localhost/celke/confirmar-email.php?token_email=$token_email \n\nEsta mensagem foi enviada a você pela empresa XXX.\nVocê está recebendo 
            porque está cadastrado no banco de dados da empresa XXX. Nenhum e-mail enviado pela empresa XXX tem arquivos anexados ou solicita o 
            preenchimento de senhas e informações cadastrais.\n\n";

            $mail->send();

            $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso. Necessário acessar a caixa de e-mail para confimar o e-mail!</div>"];

        } catch (Exception $e) {
            //$retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não cadastrado com sucesso!</div>"];

            $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não cadastrado com sucesso.</div>"];
        }
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não cadastrado com sucesso!</div>"];
    }

echo json_encode($retorna);