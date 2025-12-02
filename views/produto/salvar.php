<?php

$id = $_POST["id"] ?? NULL;
$nome = trim($_POST["nome"] ?? NULL);
$categoria_id = $_POST["categoria_id"] ?? NULL;
$descricao = trim($_POST["descricao"] ?? NULL);
$valor = trim($_POST["valor"] ?? "0");
$ativo = $_POST["ativo"] ?? NULL;          
$destaque = $_POST["destaque"] ?? NULL;    

$valor = str_replace(",", ".", $valor);
$_POST["valor"] = $valor;

if (empty($nome)) {
    echo "<script>mensagem('Digite o nome do produto','produto','error');</script>";
    exit;
}
if (empty($categoria_id)) {
    echo "<script>mensagem('Selecione a categoria','produto','error');</script>";
    exit;
}

$imagemAtual = $_POST["imagem_atual"] ?? null;

$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/show-de-feira/public/arquivos/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$nomeImagemNova = null;
$uploadOk = false;

if (!empty($_FILES['imagem']['name']) && isset($_FILES['imagem']['tmp_name']) && is_uploaded_file($_FILES['imagem']['tmp_name'])) {
    $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
    $ext = $ext ? $ext : 'jpg';

    try {
        $random = bin2hex(random_bytes(4));
    } catch (Exception $e) {
        $random = uniqid();
    }

    $nomeImagemNova = time() . '_' . $random . '.' . $ext;
    $destinoCompleto = $uploadDir . $nomeImagemNova;

    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destinoCompleto)) {
        $uploadOk = true;
        $_POST['imagem'] = $nomeImagemNova;
    } else {
        $_POST['imagem'] = $imagemAtual;
        echo "<script>mensagem('Falha ao enviar a imagem.','produto','error');</script>";
    }
} else {
    $_POST['imagem'] = $imagemAtual ?: null;
}

$msg = $this->produto->salvar($_POST);

if ($msg == 1) {
    if ($uploadOk && !empty($imagemAtual) && $imagemAtual !== $nomeImagemNova) {
        $caminhoAntigo = $uploadDir . $imagemAtual;
        if (file_exists($caminhoAntigo)) {
            @unlink($caminhoAntigo); 
        }
    }

    echo "<script>mensagem('Dados salvos com sucesso!', 'produto', 'ok')</script>";
} else {
    echo "<script>mensagem('Erro ao gravar/atualizar dados', 'produto', 'error')</script>";
}
