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

?>

<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once '../../../config/lib/vendor/autoload.php';
    
    include_once(includeURL('/config/database.php'));

    //pegando o id
    if (isset($_GET['cd_ong'])) {
        $id = filter_input(INPUT_GET, 'cd_ong');
    
        try {
            $select = $conn->prepare("SELECT * FROM tb_ong WHERE cd_ong = :id");
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
        echo "Não foi possível pegar o ID do ong.";
        exit();
    }

    if ($select->rowCount()) {

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
                                    <p>Agradecemos por se cadastrar na Plataforma Oásis. Para ativar sua conta e começar a sua jornada como voluntário, por favor, confirme seu endereço de e-mail clicando no botão abaixo:</p>
                                    <p><a class="button" href="http://localhost/oasis/views/forms/ongs/retornoEmail.php?token_email=' . $row['cd_token_email'] . '&cd_ong=' . $id . '">Confirmar E-mail</a></p>
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
            Para ativar sua conta e começar a sua jornada como voluntário, por favor, confirme seu endereço de e-mail 
            clicando no link a seguir:\n\nhttp://localhost/oasis/views/forms/ongs/retornoEmail.php?token_email=' . $row['cd_token_email'] . '&cd_ong=' . $id 
            . '\n\nSe você não se cadastrou na Plataforma Oásis, pode ignorar esta mensagem.';
            $mail->send();

            $success = true;

        } catch (Exception $e) {

            $success = false;
        }
    } else {
            $success = false;
        
    }

    if ($success) {
        $returnData = ['deu certo amigao' => true];
    } else {
        // Em caso de erro, você pode definir uma mensagem de erro personalizada.
        $errorMessage = "Houve um erro ao cadastrar o usuário.";
        $returnData = ['success' => false, 'error' => $errorMessage];
    }
    
    // Saída em formato JSON.
    echo json_encode($returnData);