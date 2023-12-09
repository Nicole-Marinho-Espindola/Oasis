<?php

session_start();

function includeURL($path = '')
{
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

if (isset($_SESSION['cd_voluntario'])) {

    //     header("Location: ../../../../index.php");

    // }

    $cd_voluntario = $_SESSION['cd_voluntario'];

    try {
        $select = $conn->prepare("SELECT v.*, tv.ds_token
                                    FROM tb_voluntario v
                                    LEFT JOIN tb_token_voluntario tv ON v.cd_voluntario = tv.cd_voluntario
                                    WHERE v.cd_voluntario = :id AND tv.cd_tipo_token = 1");
        $select->bindParam(':id', $cd_voluntario);

        if ($select->execute()) {
            $row = $select->fetch(PDO::FETCH_ASSOC);

            $mail = new PHPMailer(true);
            
            $mail->CharSet = "UTF-8";
            $mail->isSMTP();
            $mail->Host       = $_ENV['host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV['username'];
            $mail->Password   = $_ENV['password'];
            $mail->SMTPSecure = 'tls';
            $mail->Port       = $_ENV['port'];

            $mail->setFrom('oasis@oasisparatodos.com', 'Oásis');
            if (isset($row['ds_email']) && filter_var($row['ds_email'], FILTER_VALIDATE_EMAIL) && isset($row['nm_voluntario'])) {
                $mail->addAddress($row['ds_email'], $row['nm_voluntario']);
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
                                                <p>Prezado(a) ' . $row['nm_voluntario'] . ',</p>
                                                <p>Agradecemos por se cadastrar na Plataforma Oásis. Para ativar sua conta e começar a sua jornada como voluntário, por favor, confirme seu endereço de e-mail clicando no botão abaixo:</p>
                                                <p><a class="button" href="http://localhost/oasis/services/controllers/voluntarios/email/retornoEmail.php?token_email=' . $row['ds_token'] . '">Confirmar E-mail</a></p>
                                                <p>Se você não se cadastrou na Plataforma Oásis, pode ignorar esta mensagem.</p>
                                            </div>
                                            <div class="footer">
                                                Esta mensagem foi enviada a você pela Plataforma Oásis. © ' . date("Y") . '
                                            </div>
                                        </div>
                                    </body>
                                    </html>';
                $mail->Body = $emailBody;
                $mail->AltBody = 'Prezado(a) ' . $row['nm_voluntario'] . ',\n\nAgradecemos por se cadastrar na Plataforma Oásis.
                    Para ativar sua conta e começar a sua jornada como voluntário, por favor, confirme seu endereço de e-mail 
                    clicando no link a seguir:\n\nhttp://localhost/oasis/services/controllers/voluntarios/email/retornoEmail.php?token_email=' . $row['ds_token']
                    . '\n\nSe você não se cadastrou na Plataforma Oásis, pode ignorar esta mensagem.';
                $mail->send();

                $success = true;
            } else {
                echo "Erro na consulta: O endereço de e-mail não é válido ou o nome do voluntário está em branco.";
                $success = false;
            }
        } else {
            echo "Erro na consulta: " . $select->errorInfo()[2];
            $success = false;
        }
    } catch (Exception $e) {
        echo "Erro ao enviar o email: {$mail->ErrorInfo}";
        $success = false;
    }
} else {
    echo "Não foi possível pegar o ID do voluntário.";
    exit();
}

if ($success) {
    header("Location: ../../../../views/forms/voluntarios/confirmarEmail.php?email_confirmado=true");
} else {
    header("Location: ../../../../views/forms/voluntarios/confirmarEmail.php?email_confirmado=false");
}
