<?php

    session_start();

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
    require_once includeURL('/config/database.php');

    if (isset($_SESSION['cd_ong'])) {
        $cd_ong = $_SESSION['cd_ong'];

        try {
            $select = $conn->prepare("SELECT o.*, tko.ds_token
                                    FROM tb_ong o
                                    LEFT JOIN tb_token_ong tko ON o.cd_ong = tko.cd_ong
                                    WHERE o.cd_ong = :id AND tko.cd_tipo_token = 1");
            $select->bindParam(':id', $cd_ong);

            if ($select->execute()) {
                $row = $select->fetch(PDO::FETCH_ASSOC);

                $mail = new PHPMailer(true);

                $mail->CharSet = "UTF-8";
                $mail->isSMTP();
                $mail->Host       = 'mail.oasisparatodos.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = '_mainaccount@oasisparatodos.com';
                $mail->Password   = 'mudar@123';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                $mail->setFrom('oasis@oasisparatodos.com', 'Oásis'); // Substituir por um email real
                if (isset($row['ds_email']) && filter_var($row['ds_email'], FILTER_VALIDATE_EMAIL) && isset($row['nm_ong'])) {
                    $mail->addAddress($row['ds_email'], $row['nm_ong']);

                    $mail->isHTML(true);
                    $mail->Subject = 'Confirme seu cadastro na Plataforma Oásis';

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
                                                box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
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
                                                <h1>Confirme seu cadastro na Plataforma Oásis</h1>
                                            </div>
                                            <div class="content">
                                                <p>Prezado(a) ' . $row['nm_ong'] . ',</p>
                                                <p>Agradecemos por se cadastrar na Plataforma Oásis. Para ativar sua conta e começar a sua jornada como ong, por favor, confirme seu endereço de e-mail clicando no botão abaixo:</p>
                                                <p><a class="button" href="http://localhost/oasis/services/controllers/ongs/email/retornoEmail.php?token_email=' . $row['ds_token'] .'">Confirmar E-mail</a></p>
                                                <p>Se você não se cadastrou na Plataforma Oásis, pode ignorar esta mensagem.</p>
                                            </div>
                                            <div class="footer">
                                                Esta mensagem foi enviada a você pela Plataforma Oásis. © ' . date("Y") . '
                                            </div>
                                        </div>
                                    </body>
                                    </html>';
                    $mail->Body = $emailBody;
                    $mail->AltBody = 'Prezado(a) ' . $row['nm_ong'] . ',\n\nAgradecemos por se cadastrar na Plataforma Oásis.
                    Para ativar sua conta e começar a sua jornada como ong, por favor, confirme seu endereço de e-mail 
                    clicando no link a seguir:\n\nhttp://localhost/oasis/services/controllers/ongs/email/retornoEmail.php?token_email=' . $row['ds_token']
                    . '\n\nSe você não se cadastrou na Plataforma Oásis, pode ignorar esta mensagem.';
                    $mail->send();

                    header("Location: ../../../../views/forms/ongs/confirmarEmail.php?email_confirmado=true");
                    exit();

                } else {
                    header("Location: ../../../../views/forms/ongs/confirmarEmail.php?email_confirmado=false");
                    exit();
                }
            } else {
                echo "Erro na consulta: " . $select->errorInfo()[2];

            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "Não foi possível pegar o ID da ONG.";
        exit();
    }

?>