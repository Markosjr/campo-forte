<?php
    $email = $_POST["email"] ?? NULL;
    $nome = trim($_POST["nome"] ?? NULL);

    if (empty($nome)) {
        echo "<script>alert('Digite um nome');history.back();</script>";
    }

    $msg = $this->carrinho->salvar($_POST);

    echo "<br>";


    if ($msg == 1) {
        ?>

        <p class="alert alert-success text-center">
            <strong> Pronto!</strong> Seu cadastro foi realizado com sucesso! <br>
            <a href="carrinho/finalizar">Clique aqui e faca seu login</a>
        </p>
        <?php
    }else if ($msg == 0) {
        ?>
        <p class="text-center alert-danger">
            Ops! Erro ao cadastrar! Tente novamente <br>
            <a href="javascript:history.back()"> Voltar a tela de cadastro</a>
        </p>
        <?php
    } else {
        ?>
        <p class="text-center alert-danger">
           Este e-mail <?= $email ?> ja esta cadastrado! <br>
            <a href="javascript:history.back()"> Voltar a tela de cadastro</a>
        </p>
        <?php
    }