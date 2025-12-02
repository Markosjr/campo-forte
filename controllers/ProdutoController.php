<?php

require "../config/Conexao.php";
require "../models/Produto.php";

class ProdutoController {

    private $produto;

    public function __construct()
    {
        $db = new Conexao();
        $pdo = $db->conectar();
        $this->produto = new Produto($pdo);
    }

    public function index($id = null)
    {
        $dados = null;

        if (!empty($id)) {
            $dados = $this->produto->buscarPorId($id);
        }

        require "../views/produto/index.php";
    }

    public function detalhes($id)
    {
        if (empty($id)) {
            echo "<script>mensagem('Produto não encontrado','home','error')</script>";
            return;
        }

        $produto = $this->produto->buscarPorId($id);

        require "../views/produto/detalhes.php";
    }

    public function salvar()
    {
        if ($_POST) {

            $dados = [];
            $dados["id"] = $_POST["id"] ?? NULL;
            $dados["nome"] = $_POST["nome"] ?? "";
            $dados["descricao"] = $_POST["descricao"] ?? "";
            $dados["categoria_id"] = $_POST["categoria_id"] ?? "";
            $dados["destaque"] = $_POST["destaque"] ?? "N";
            $dados["ativo"] = $_POST["ativo"] ?? "N";

            $valor = $_POST["valor"] ?? "0";
            $valor = str_replace(".", "", $valor);
            $valor = str_replace(",", ".", $valor);
            $dados["valor"] = $valor;

            $dados["imagem"] = $_POST["imagem_atual"] ?? "";

            if (!empty($_FILES["imagem"]["name"])) {

                $origem = $_FILES["imagem"]["tmp_name"];
                $ext = strtolower(pathinfo($_FILES["imagem"]["name"], PATHINFO_EXTENSION));

                if (!in_array($ext, ["jpg", "jpeg", "png"])) {
                    echo "<script>alert('Formato inválido');history.back()</script>";
                    exit;
                }

                $nomeImagem = time() . ".jpg";
                move_uploaded_file($origem, "../public/arquivos/" . $nomeImagem);

                $dados["imagem"] = $nomeImagem;
            }

            if ($this->produto->salvar($dados)) {
                echo "<script>mensagem('Produto salvo com sucesso','produto/listar','success')</script>";
            } else {
                echo "<script>mensagem('Falha ao salvar','produto/listar','error')</script>";
            }

        } else {
            echo "<script>mensagem('Requisição inválida','produto','error')</script>";
        }
    }

    public function excluir($id)
    {
        if ($this->produto->excluir($id)) {
            echo "<script>mensagem('Produto excluído com sucesso','produto/listar','success')</script>";
        } else {
            echo "<script>mensagem('Erro ao excluir','produto/listar','error')</script>";
        }
    }

    public function listar()
    {
        if (!empty($_GET["destaque"])) {
            $lista = $this->produto->listarDestaque();
        } else {
            $lista = $this->produto->listar();
        }

        require "../views/produto/listar.php";
    }
}
