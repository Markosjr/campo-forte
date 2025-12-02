<?php

if (empty($id)){
    echo "<script>mensagem('Registro invalido', 'produto', 'error')</script>";
}else {

    $msg = $this ->produto->excluir($id);

    if($msg == 1){
        echo "<script>mensagem('Registro excluido','produto/listar', 'ok')</script>";
    } else {
        echo "<script>mensagem('Erro ao excluir','produto', 'error')</script>";
    }
}