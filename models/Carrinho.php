<?php

    class Carrinho {
        private $pdo;
        
        public function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        public function salvar($dados) {
            $sqlVerifica = "select id from cliente where email = :email limit 1";
            $consultaVerifica = $this->pdo->prepare($sqlVerifica);
            $consultaVerifica->bindParam(":email", $dados["email"]);
            $consultaVerifica->execute();

            $dadosVerifica = $consultaVerifica->fetch(PDO::FETCH_OBJ);

            if (empty($dadosVerifica->id)) {
                $senha = password_hash($dados["senha"], PASSWORD_BCRYPT);

                $sqlCliente = "insert into cliente values(NULL, :nome, :email, :senha)";
                $consultaCliente = $this->pdo->prepare($sqlCliente);
                $consultaCliente->bindParam(":nome", $dados["nome"]);
                $consultaCliente->bindParam(":email", $dados["email"]);
                $consultaCliente->bindParam(":senha", $senha);

                return $consultaCliente->execute();


            } else {
                return 2;
            }
        }

        public function logar ($email) {
            $sql = "select * from cliente where email = :email limit 1";
            $consulta = $this->pdo->prepare($sql);
            $consulta->bindParam(":email", $email);
            $consulta->execute();

            return $consulta->fetch(PDO::FETCH_OBJ);
        }

    }