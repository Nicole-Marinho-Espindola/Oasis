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

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once includeURL('config/lib/vendor/autoload.php');
    include_once includeURL('/config/database.php');

    if (!empty($_POST)) {

        $email = $_POST['email'];

        try {
            
            $stmt = $conn->prepare("SELECT cd_voluntario, nm_voluntario, ds_email FROM tb_voluntario WHERE ds_email = :email LIMIT 1");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() != 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Gerando token
                $token = bin2hex(random_bytes(32));
                $tipoToken = 2; // 2 é para redefinição de senha
                $dt_pedido = date('Y-m-d H:i:s');
                $dt_expiracao = date('Y-m-d H:i:s', strtotime('+10 minutes')); // 10 minutos a partir do pedido

                // Inserindo token no banco de dados
                $stmtToken = $conn->prepare("INSERT INTO tb_token_voluntario (cd_tipo_token, cd_voluntario, ds_token, dt_pedido, dt_expiracao) 
                                                VALUES (:tipo_token, :voluntario, :token, :dt_pedido, :dt_expiracao)");
                $stmtToken->bindParam(':tipo_token', $tipoToken);
                $stmtToken->bindParam(':voluntario', $row['cd_voluntario']);
                $stmtToken->bindParam(':token', $token);
                $stmtToken->bindParam(':dt_pedido', $dt_pedido);
                $stmtToken->bindParam(':dt_expiracao', $dt_expiracao);

                if ($stmtToken->execute()) {

                    $link = "http://localhost/oasis/views/forms/voluntarios/atualizarSenha.php?token_senha=" . $token;

                    // Enviar e-mail com o link de redefinição de senha
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

                        $mail->setFrom('mairalinda@gmail.com.br', 'Maíra'); // Substituir por um email real
                        $mail->addAddress($row['ds_email'], $row['nm_voluntario']);

                        $mail->isHTML(true);
                        $mail->Subject = 'Redefinir Senha na Plataforma Oásis';

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

                                    .button {
                                        display: inline-block;
                                        padding: 10px 20px;
                                        background-color: #4CAF50;
                                        color: #fff;
                                        text-decoration: none;
                                        border-radius: 5px;
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
                                        <h1>Redefinir Senha na Plataforma Oásis</h1>
                                    </div>
                                    <div class="content">
                                        <p>Prezado(a) ' . $row['nm_voluntario'] . ',</p>
                                        <p>Você solicitou a redefinição da sua senha na Plataforma Oásis. Para criar uma nova senha, clique no botão abaixo:</p>
                                        <p><a class="button" href="' . $link . '">Redefinir Senha</a></p>
                                        <p>Se você não solicitou essa redefinição, pode ignorar esta mensagem.</p>
                                    </div>
                                    <div class="footer">
                                        Esta mensagem foi enviada a você pela Plataforma Oásis. © ' . date("Y") . '
                                    </div>
                                </div>
                            </body>
                        </html>';

                        $mail->Body = $emailBody;
                        $mail->AltBody = 'Prezado(a) ' . $row['nm_voluntario'] . ',\n\nVocê solicitou a redefinição de senha na Plataforma Oásis.
                            Para criar uma nova senha, clique no link abaixo ou cole o endereço no seu navegador:\n\n'. $link . '\n\n
                            Se você não solicitou essa redefinição, pode ignorar esta mensagem.';
                        $mail->send();

                        $success = true;

                    } catch (Exception $e) {
                        echo "Erro no envio de e-mail: " . $mail->ErrorInfo;
                        $success = false;
                    }
                } else {
                    echo "Erro ao inserir token no banco de dados.";
                    $success = false;
                }
            } else {
                echo "Nenhum usuário encontrado com o e-mail fornecido.";
                $success = false;
            }
        } catch (PDOException $e) {
            echo "Erro no banco de dados: " . $e->getMessage();
            $success = false;
        }
    }

    if ($success) {
        $returnData = ['deu certo amigão' => true];
    } else {
        // Em caso de erro, você pode definir uma mensagem de erro personalizada.
        $errorMessage = "Houve um erro";
        $returnData = ['success' => false, 'error' => $errorMessage];
    }

    // Saída em formato JSON.
    echo json_encode($returnData);

?>