<?php

header("Content-Type: application/json");

require "../../config/Conexao.php";
$db = new Conexao();
$pdo = $db->conectar();



if (isset($_GET["excluir"])) {

    $id = (int) $_GET["excluir"];

    if ($id > 0) {

        $sql = "DELETE FROM produto WHERE id = :id LIMIT 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);

        if ($consulta->execute()) {
            header("Location: /produto/listar");
            exit;
        } else {
            echo json_encode(["erro" => "Falha ao excluir"]);
            exit;
        }
    }
}


$id        = $_GET["id"]        ?? null;
$categoria = $_GET["categoria"] ?? null;
$destaque  = $_GET["destaque"]  ?? null;

if (!empty($categoria)) {

    $sql = "SELECT * FROM produto 
            WHERE ativo = 'S' AND categoria_id = :categoria
            ORDER BY nome";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":categoria", $categoria);
    $consulta->execute();
    $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);

} elseif (!empty($id)) {

    $sql = "SELECT * FROM produto 
            WHERE ativo = 'S' AND id = :id LIMIT 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $id);
    $consulta->execute();
    $dados = $consulta->fetch(PDO::FETCH_ASSOC);

} elseif (!empty($destaque)) {

    $sql = "SELECT * FROM produto 
            WHERE ativo = 'S' AND destaque = 'S'
            ORDER BY nome";
    $consulta = $pdo->query($sql);
    $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);

} else {

    $sql = "SELECT * FROM produto 
            WHERE ativo = 'S'
            ORDER BY nome";
    $consulta = $pdo->query($sql);
    $dados = $consulta->fetchAll(PDO::FETCH_ASSOC);
}

echo json_encode($dados);
