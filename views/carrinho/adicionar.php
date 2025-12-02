<?php
$urlProduto = "http://localhost/show-de-feira/public/apis/produto.php?id={$id}";
$dadosProduto = json_decode(file_get_contents($urlProduto));

$img = "http://localhost/show-de-feira/public/arquivos/";


    if (!empty($dadosProduto->id)) {

        $qtde = $_SESSION["carrinho"] [$id] ["qtde"] ?? 0;
        $qtde++;


        $_SESSION["carrinho"] [$id] = array ("id" => $dadosProduto->id,
        "nome" => $dadosProduto->nome,
        "qtde" => $qtde,
        "valor" => $dadosProduto->valor,
        "imagem" => $dadosProduto->imagem);

        echo "<script>location.href='carrinho'</script>";

    } else {
        echo "<h2> Produto Inválido</h2>";
    }

?>