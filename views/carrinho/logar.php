<?php
    $email = $_POST["email"] ?? NULL;
        $senha = $_POST["senha"] ?? NULL;


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('E-mail Invalido');history.back();</script>";
    }

    $dados = $this->carrinho->logar($email);

    if (empty($dados->id)) {
        echo "<script>alert('Usuario nao encontrado');history.back();</script>";
    }else if (!password_verify($senha, $dados->senha)){
        echo "<script>alert('Usuario ou senha invalidos');history.back();</script>";

    }

    $_SESSION ["cliente"] = array("id" => $dados->id,
        "nome" => $dados->nome,
        "email" => $dados->email);

    echo "<script>location.href='carrinho/index';</script>";