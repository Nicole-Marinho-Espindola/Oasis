<?php
    include_once('../../views/includes/head.php');
?>

<link rel="stylesheet" href="(../../assets/css/form.css') ?>">

    <div class="content">
        <div class="form-block">
            <div class="form-title">
                <h1 class="title">Cadastro de voluntários!</h1>
                <div class="line"></div>
            </div>
<<<<<<< HEAD
            <form class="form" action="../../services/CRUD/voluntario/cadastro.php" method="POST" enctype="multipart/form-data"
                    onsubmit="return limitarSelecoes(3);">
=======
            <form class="form" action="" method="POST" enctype="multipart/form-data"
                    onsubmit="return limitarSelecoes(3);" id="form">
>>>>>>> 50b5d72d72f493fa9a32ea83ab44f5191657b26e
                <div class="section active">
                    <div class="user-info-block">
                        <label class="" for="">Nome:
                            <div class="form-input-block required">
                                <i class="fa-solid fa-user icon-green"></i>
                                <input class="input input-size icon-green" type="text"
                                    id="nomeVoluntario" name="nomeVoluntario" oninput="nameValidate()">
                            </div>
                            <span class="span-required">Mínimo de 3 caracteres</span>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label class="" for="">Sobrenome:
                            <div class="form-input-block">
                                <i class="fa-solid fa-user icon-green"></i>
                                <input class="input input-size" type="text"
                                    id="sobrenomeVoluntario" name="sobrenomeVoluntario" required>
                            </div>
                        </label>
                    </div>
                    <div class="user-info-block">
                        <label class="" for="">Data de nascimento:
                            <div class="form-input-block">
                                <input class="input input-size" type="date"
                                    id="nascimentoVoluntario" name="nascimentoVoluntario" required>
                            </div>
                        </label>
                    </div>
                    <button type="button" class="btn btn-color" onclick="passarEtapa()">Próximo</button>
                </div>


                <div class="section">
                    <div class="user-info-block">
                        <div class="center-itens subtitle-block">
                            <span class="subtitle">Selecione até 3 interesses:</span>
                            <div class="line line-thin"></div>
                        </div>
                        <div class="container">
                                <div class="label-interesse">
                                    <input type="checkbox" name="interesses[]"
                                        value= "praia" id="praia">
                                    <label for="praia">Praia</label>
                                </div>
                                <div class="label-interesse">
                                    <input type="checkbox" name="interesses[]"
                                        value= "ambiente" id="ambiente">
                                    <label for="ambiente">Meio ambiente</label>
                                </div>
                                <div class="label-interesse">
                                    <input type="checkbox" name="interesses[]"
                                        value= "limpeza" id="limpeza">
                                    <label for="limpeza">Limpeza na praia</label>
                                </div>
                                <div class="label-interesse">
                                    <input type="checkbox" name="interesses[]"
                                        value= "esportes" id="esportes">
                                    <label for="esportes">Esportes na praia</label>
                                </div>
                                <div class="label-interesse">
                                    <input type="checkbox" name="interesses[]"
                                        value= "eventos" id="eventos">
                                    <label for="eventos">Eventos</label>
                                </div>
                                <div class="label-interesse">
                                    <input type="checkbox" name="interesses[]"
                                        value= "natureza" id="natureza">
                                    <label for="natureza">Cuidar da natureza</label>
                                </div>
                                <div class="label-interesse">
                                    <input type="checkbox" name="interesses[]"
                                        value= "plantas" id="plantas">
                                    <label for="plantas">Cuidar das plantas</label>
                                </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-color" onclick="passarEtapa()">Próximo</button>
                </div>


                <div class="section">
                    <div class="user-info-block">
                        <label class="" for="email">Email:
                            <div class="form-input-block required">
                                <i class="fa-regular fa-envelope icon-green"></i>
                                <input class="input input-size" type="text" oninput="validarEmail(this.value)"
                                    id="emailVoluntario" name="emailVoluntario" requerid>
                                <span class="span-required">Email inválido</span>
                            </div>
                            <!-- <div id="mensagem"></div> -->
                        </label>
                    </div>
                    <div class="user-info-block">
                    <label for="">Senha:
                            <div class="form-input-block">
                                <i class="fa-solid fa-lock"></i>
                                <input class="input" type="password"
                                    id="senhaVoluntario" name="senhaVoluntario" required>
                                <i class="fa-regular fa-eye-slash icon-green"></i>
                            </div>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-color">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<<<<<<< HEAD
=======
<?php
if (!empty($_POST) && !isset($_SESSION['cadastro_realizado'])) {
    

    $nome = $_POST['nomeVoluntario'];
    $dt_nasc = $_POST['nascimentoVoluntario'];
    $email = $_POST['emailVoluntario'];
    $senha = $_POST['senhaVoluntario'];
    $interesses = implode(', ', $_POST['interesses']); // Transforma o array de interesses em uma string

    include_once('../../config/database.php');

    try {
        $hashDaSenha = password_hash($senha, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO tb_voluntario (nm_voluntario, dt_nascimento, ds_email, cd_senha, ds_interesse)
                                VALUES (:nome, :dt_nasc, :email, :senha, :interesse)");

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':dt_nasc', $dt_nasc);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':interesse', $interesses);
        $stmt->bindParam(':senha', $hashDaSenha);

        $stmt->execute();

        echo "<script>alert('Cadastrado com Sucesso');</script>";

        $_SESSION['cadastro_realizado'] = true;

    } catch (PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }
    $conn = null;
}

?>
<script src="<?= baseUrl('/assets/js/validarInput.js') ?>"></script>
>>>>>>> 50b5d72d72f493fa9a32ea83ab44f5191657b26e
<script src="<?= baseUrl('/assets/js/cadastroEtapas.js') ?>"></script>
<script src="<?= baseUrl('/assets/js/limitarSelecoes.js') ?>"></script>
<script src="<?= baseUrl('/assets/js/validarEmail.js') ?>"></script>