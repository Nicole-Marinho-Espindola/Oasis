
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
</head>

<body>

<?php

    function includeURL($path = '') {
        return sprintf(
            "%s/%s/%s",
            $_SERVER['DOCUMENT_ROOT'],
            'Oasis',
            $path
        );
    }

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    include_once includeURL('/services/helpers.php');
    include_once includeURL('/config/database.php');

    const SMTP_HOST = 'sandbox.smtp.mailtrap.io';
    const SMTP_PORT = 2525;
    const SMTP_USERNAME = '73007940ef36e3';
    const SMTP_PASSWORD = '4017fe2ab23566';

    function enviarEmailConfirmacao($nome, $email, $mensagem)
    {
        try {
            $mail = new PHPMailer(true);
            $mail->CharSet = "UTF-8";
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USERNAME;
            $mail->Password = SMTP_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = SMTP_PORT;

            $mail->setFrom('mairalinda@gmail.com.br', 'Maíra');
            $mail->addAddress($email, $nome);

            $mail->isHTML(true);
            $mail->Subject = 'Senha Redefinida na Plataforma Oásis';
            $mail->Body = $mensagem;

            $mail->send();

            echo '<script src="../../../assets/js/alerts.js"></script>';
            echo '<script>alertSenhaConfirm();</script>';
            header("Refresh: 1.5; URL=http://localhost/oasis/views/forms/senha/atualizarSenha.php");
            exit();

        } catch (Exception $e) {
            echo "Erro no envio de e-mail: " . $e->getMessage();
        }

        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $token_senha = filter_input(INPUT_POST, 'token_senha', FILTER_DEFAULT);

        try {
            $stmt = $conn->prepare("SELECT t.ds_token, t.cd_voluntario, t.dt_expiracao, v.nm_voluntario, v.ds_email
                                    FROM tb_token_voluntario t
                                    JOIN tb_voluntario v ON t.cd_voluntario = v.cd_voluntario
                                    WHERE t.ds_token = :token_senha
                                    AND t.cd_tipo_token = 2
                                    AND t.cd_token_usado = 0
                                    LIMIT 1");
            $stmt->bindParam(':token_senha', $token_senha, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $rowToken = $stmt->fetch(PDO::FETCH_ASSOC);
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
                            // Marcar o token como usado
                            $stmtMarcaToken = $conn->prepare("UPDATE tb_token_voluntario
                                                            SET cd_token_usado = 1
                                                            WHERE ds_token = :token");
                            $stmtMarcaToken->bindParam(':token', $token_senha, PDO::PARAM_STR);
                            $stmtMarcaToken->execute();
                            
                            // Enviar e-mail de confirmação
                            $mensagem = '<html>
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
                            enviarEmailConfirmacao($rowToken['nm_voluntario'], $rowToken['ds_email'], $mensagem);
                        } else {
                            echo '<script src="../../../assets/js/alerts.js"></script>';
                            echo '<script>alertSenhaFail();</script>';
                        }
                    } else {
                        echo '<script src="../../../assets/js/alerts.js"></script>';
                        echo '<script>alertSenhaFail();</script>';
                    }
                } else {
                    echo '<script src="../../../assets/js/alerts.js"></script>';
                    echo '<script>alertSenhaExpired();</script>';
                }
            } else {
                $stmtOng = $conn->prepare("SELECT t.ds_token, t.cd_ong, t.dt_expiracao, o.nm_ong, o.ds_email
                                            FROM tb_token_ong t
                                            JOIN tb_ong o ON t.cd_ong = o.cd_ong
                                            WHERE t.ds_token = :token_senha
                                            AND t.cd_tipo_token = 2
                                            AND t.cd_token_usado = 0
                                            LIMIT 1");
                $stmtOng->bindParam(':token_senha', $token_senha, PDO::PARAM_STR);
                $stmtOng->execute();
    
                if ($stmtOng->rowCount() > 0) {
                    $rowTokenOng = $stmtOng->fetch(PDO::FETCH_ASSOC);
                    date_default_timezone_set('America/Sao_Paulo');
                    $dtExpiracaoOng = new DateTime($rowTokenOng['dt_expiracao']);
                    $dtAtualOng = new DateTime();
    
                    if ($dtAtualOng < $dtExpiracaoOng) {
                        $idOng = $rowTokenOng['cd_ong'];
    
                        if (!empty($_POST['senha'])) {
                            $senhaOng = $_POST['senha'];
                            $hashDaSenhaOng = password_hash($senhaOng, PASSWORD_DEFAULT);
    
                            $stmtSenhaOng = $conn->prepare("UPDATE tb_ong
                                                            SET cd_senha = :senha
                                                            WHERE cd_ong = :id");
                            $stmtSenhaOng->bindParam(':senha', $hashDaSenhaOng, PDO::PARAM_STR);
                            $stmtSenhaOng->bindParam(':id', $idOng, PDO::PARAM_INT);
    
                            if ($stmtSenhaOng->execute()) {
                                // Marcar o token como usado
                                $stmtMarcaTokenOng = $conn->prepare("UPDATE tb_token_ong
                                                                    SET cd_token_usado = 1
                                                                    WHERE ds_token = :token");
                                $stmtMarcaTokenOng->bindParam(':token', $token_senha, PDO::PARAM_STR);
                                $stmtMarcaTokenOng->execute();

                                // Enviar e-mail de confirmação
                                $mensagemOng = '<html>
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
                                            <p>Olá ' . $rowTokenOng['nm_ong'] . ',</p>
                                            <p>Sua senha na Plataforma Oásis foi redefinida com sucesso. Se você fez essa alteração, pode ignorar esta mensagem.</p>
                                            <p>Se você não solicitou a redefinição da senha ou tem alguma dúvida, entre em contato conosco imediatamente.</p>
                                        </div>
                                        <div class="footer">
                                            Esta mensagem foi enviada a você pela Plataforma Oásis. © ' . date("Y") . '
                                        </div>
                                    </div>
                                </body>
                            </html>';
                                enviarEmailConfirmacao($rowTokenOng['nm_ong'], $rowTokenOng['ds_email'], $mensagemOng);
                            } else {
                                echo '<script src="../../../assets/js/alerts.js"></script>';
                                echo '<script>alertSenhaFail();</script>';
                                header("Refresh: 1.5; URL=http://localhost/oasis/views/forms/senha/atualizarSenha.php");
                            }
                        } else {
                            echo '<script src="../../../assets/js/alerts.js"></script>';
                            echo '<script>alertSenhaFail();</script>';
                            header("Refresh: 1.5; URL=http://localhost/oasis/views/forms/senha/atualizarSenha.php");
                        }
                    } else {
                        echo '<script src="../../../assets/js/alerts.js"></script>';
                        echo '<script>alertSenhaExpired();</script>';
                        header("Refresh: 1.5; URL=http://localhost/oasis/views/forms/senha/atualizarSenha.php");
                    }
                } else {
                    echo '<script src="../../../assets/js/alerts.js"></script>';
                    echo '<script>alertSenhaRepeat();</script>';
                    header("Refresh: 1.5; URL=http://localhost/oasis/views/forms/senha/atualizarSenha.php");
                    exit();
                }
            }
        } catch (PDOException $e) {
            echo "Erro no banco de dados: " . $e->getMessage();
        }
    }
?>
</body>