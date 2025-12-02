<?php
require_once "../models/Categoria.php";

class CategoriaController {

    private $categoria;

    public function __construct() {
        $this->categoria = new Categoria();
    }

    public function index($id = NULL) {
        require "../views/categoria/categoria.php";
    }

    public function salvar() {
        $this->categoria->id = $_POST["id"] ?? null;
        $this->categoria->descricao = $_POST["nome"] ?? null;

        $this->categoria->salvar();

        echo "<script>mensagem('Categoria salva com sucesso!', 'categoria', 'success')</script>";
    }

    public function listar() {
        $lista = Categoria::listar();
        require "../views/categoria/listar.php"; 
    }

    public function editar($id) {
        $dados = $this->categoria->editar($id);
        require "../views/categoria/categoria.php";
    }

    public function excluir($id) {
        $this->categoria->excluir($id);

        echo "<script>mensagem('Categoria excluída!', 'categoria/listar', 'success')</script>";
    }
}
