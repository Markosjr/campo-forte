<?php

class Produto
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

   
    public function listar()
    {
        return $this->listarTodos();
    }

    public function listarDestaque()
    {
        return $this->listarDestaques();
    }

    public function listarTodos()
    {
        $sql = "SELECT * FROM produto 
                WHERE ativo = 'S'
                ORDER BY nome";
        $consulta = $this->pdo->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_OBJ);
    }

    public function listarDestaques()
    {
        $sql = "SELECT * FROM produto 
                WHERE destaque = 'S' 
                AND ativo = 'S'
                ORDER BY nome";
        $consulta = $this->pdo->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_OBJ);
    }

    public function listarPorCategoria($categoria_id)
    {
        $sql = "SELECT * FROM produto 
                WHERE categoria_id = :categoria_id
                AND ativo = 'S'
                ORDER BY nome";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":categoria_id", $categoria_id);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_OBJ);
    }

  

    public function salvar($dados)
    {
        if (empty($dados["id"])) {
            $sql = "INSERT INTO produto 
                    (id, nome, categoria_id, descricao, valor, destaque, ativo, imagem) 
                    VALUES (NULL, :nome, :categoria_id, :descricao, :valor, :destaque, :ativo, :imagem)";
        } else {
            $sql = "UPDATE produto SET 
                        nome = :nome,
                        categoria_id = :categoria_id,
                        descricao = :descricao,
                        valor = :valor,
                        destaque = :destaque,
                        ativo = :ativo,
                        imagem = :imagem
                    WHERE id = :id LIMIT 1";
        }

        $consulta = $this->pdo->prepare($sql);

        $consulta->bindParam(":nome", $dados["nome"]);
        $consulta->bindParam(":categoria_id", $dados["categoria_id"]);
        $consulta->bindParam(":descricao", $dados["descricao"]);
        $consulta->bindParam(":valor", $dados["valor"]);
        $consulta->bindParam(":destaque", $dados["destaque"]);
        $consulta->bindParam(":ativo", $dados["ativo"]);
        $consulta->bindParam(":imagem", $dados["imagem"]);

        if (!empty($dados["id"])) {
            $consulta->bindParam(":id", $dados["id"]);
        }

        return $consulta->execute();
    }

    public function editar($id)
    {
        $sql = "SELECT * FROM produto WHERE id = :id LIMIT 1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_OBJ);
    }

    public function excluir($id)
    {
        $sql = "DELETE FROM produto WHERE id = :id LIMIT 1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        return $consulta->execute();
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM produto WHERE id = :id LIMIT 1";
        $consulta = $this->pdo->prepare($sql);
        $consulta->bindParam(":id", $id, PDO::PARAM_INT);
        $consulta->execute();
        return $consulta->fetch(PDO::FETCH_OBJ);
    }



    public function listarCategoria()
    {
        $sql = "SELECT * FROM categoria ORDER BY descricao";
        $consulta = $this->pdo->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_OBJ);
    }
}
