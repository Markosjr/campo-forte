<?php
require_once "../config/Conexao.php";

class Categoria {

    public $id;
    public $descricao;

    public function salvar() {
        $con = Conexao::conectar();

        if ($this->id) {
            $sql = $con->prepare("UPDATE categoria SET descricao = ? WHERE id = ?");
            return $sql->execute([$this->descricao, $this->id]);
        } else {
            $sql = $con->prepare("INSERT INTO categoria (descricao) VALUES (?)");
            return $sql->execute([$this->descricao]);
        }
    }

    public function editar($id) {
        $con = Conexao::conectar();
        $sql = $con->prepare("SELECT * FROM categoria WHERE id = ?");
        $sql->execute([$id]);
        return $sql->fetch(PDO::FETCH_OBJ);
    }

    public function excluir($id) {
        $con = Conexao::conectar();
        $sql = $con->prepare("DELETE FROM categoria WHERE id = ?");
        return $sql->execute([$id]);
    }

    public static function listar() {
        $con = Conexao::conectar();
        $sql = $con->query("SELECT * FROM categoria ORDER BY descricao");
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
}
