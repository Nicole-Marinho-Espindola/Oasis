<?php

    function includeURL($path = '') {
        return sprintf(
            "%s/%s/%s",
            $_SERVER['DOCUMENT_ROOT'],
            'Oasis',
            $path
        );
    }

    include_once(includeURL('/services/helpers.php'));
    include_once(includeURL('/config/database.php'));

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $token_senha = filter_input(INPUT_POST, 'token_senha', FILTER_DEFAULT);

        if (!empty($token_senha)) {
            try {
                $selectToken = $conn->prepare("SELECT t.cd_voluntario, t.dt_expiracao, v.nm_voluntario, v.ds_email
                                            FROM tb_token_voluntario t
                                            JOIN tb_voluntario v ON t.cd_voluntario = v.cd_voluntario
                                            WHERE t.ds_token = :token_senha
                                            AND t.cd_tipo_token = 2
                                            AND t.cd_token_usado = 0
                                            LIMIT 1");
                $selectToken->bindParam(':token_senha', $token_senha, PDO::PARAM_STR);
                $selectToken->execute();

                if ($selectToken->rowCount() > 0) {
                    $rowToken = $selectToken->fetch(PDO::FETCH_ASSOC);
                    date_default_timezone_set('America/Sao_Paulo');
                    $dtExpiracao = new DateTime($rowToken['dt_expiracao']);
                    $dtAtual = new DateTime();

                    if ($dtAtual < $dtExpiracao) {
                        $id = $rowToken['cd_voluntario'];

                        if (!empty($_POST['senha'])) {
                            $senha = $_POST['senha'];
                            $hashDaSenha = password_hash($senha, PASSWORD_DEFAULT);

                            $stmtSenha = $conn->prepare("UPDATE tb_voluntario
                                                        SET cd_senha = :senha
                                                        WHERE cd_voluntario = :id");

                            $stmtSenha->bindParam(':senha', $hashDaSenha, PDO::PARAM_STR);
                            $stmtSenha->bindParam(':id', $id, PDO::PARAM_INT);

                            if ($stmtSenha->execute()) {

                                // Enviar e-mail de confirmação
                                try {
                                    $mail = new PHPMailer(true);
                                    $mail->CharSet = "UTF-8";
                                    $mail->isSMTP();
                                    $mail->Host = 'sandbox.smtp.mailtrap.io';
                                    $mail->SMTPAuth = true;
                                    $mail->Username = '7e5019eaaeceaf';
                                    $mail->Password = 'a77db86086ea94';
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                    $mail->Port = 2525;

                                    $mail->setFrom('mairalinda@gmail.com.br', 'Maíra');
                                    $mail->addAddress($rowToken['ds_email'], $rowToken['nm_voluntario']);

                                    $mail->isHTML(true);
                                    $mail->Subject = 'Senha Redefinida na Plataforma Oásis';

                                    $emailBody = '<html>
                                        <head>
                                            <style>
                                                /* Adicione estilos de formatação aqui */
                                                body {
                                                    font-family: Arial, sans-serif;
                                                    background-color: #f5f5f5;
                                                }
                                        
                                                .container {
                                                    max-width: 600px;
                                                    margin: 0 auto;
                                                    padding: 20px;
                                                    background-color: #ffffff;
                                                    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
                                                }
                                        
                                                .header {
                                                    background-color: #4CAF50;
                                                    color: #fff;
                                                    padding: 20px;
                                                    text-align: center;
                                                }
                                        
                                                .content {
                                                    padding: 20px;
                                                }
                                        
                                                .footer {
                                                    margin-top: 20px;
                                                    text-align: center;
                                                    color: #555;
                                                }
                                            </style>
                                        </head>
                                        <body>
                                            <div class="container">
                                                <div class="header">
                                                    <h1>Sua Senha foi Redefinida com Sucesso!</h1>
                                                </div>
                                                <div class="content">
                                                    <p>Olá ' . $rowToken['nm_voluntario'] . ',</p>
                                                    <p>Sua senha na Plataforma Oásis foi redefinida com sucesso. Se você fez essa alteração, pode ignorar esta mensagem.</p>
                                                    <p>Se você não solicitou a redefinição da senha ou tem alguma dúvida, entre em contato conosco imediatamente.</p>
                                                </div>
                                                <div class="footer">
                                                    Esta mensagem foi enviada a você pela Plataforma Oásis. © ' . date("Y") . '
                                                </div>
                                            </div>
                                        </body>
                                    </html>';

                                    $mail->Body = $emailBody;
                                    $mail->send();

                                    echo "Senha atualizada com sucesso! Um e-mail de confirmação foi enviado.";

                                } catch (Exception $e) {
                                    echo "Erro no envio de e-mail: " . $e->getMessage();
                                }

                                exit(); // Termina a execução após redirecionar.
                            } else {
                                echo "Erro: Tente novamente!";
                            }
                        } else {
                            echo "Erro: Campo de senha vazio!";
                        }
                    } else {
                        echo "Erro: Este link de redefinição de senha expirou. Solicite um novo link.";
                    }
                } else {
                    echo "Erro: Link inválido ou já utilizado. Solicite um novo link para atualizar a senha!";
                }
            } catch (PDOException $e) {
                echo "Erro no banco de dados: " . $e->getMessage();
            }
        } else {
            echo "Erro: Não foi possível obter o token da URL.";
        }
    }
?>
