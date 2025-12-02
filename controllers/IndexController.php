<?php

    require "../config/Conexao.php";
    require "../models/Usuario.php";

    class IndexController {

        public $usuario;

        public function __construct()
        {
            $db = new Conexao();
            $pdo = $db->conectar();
            $this->usuario = new Usuario($pdo);
        }

        public function index (){
            require "../views/index/index.php";
        }

        public function erro(){
            require "../views/index/erro.php";
        }

        public function sair(){
            // session_destroy();
            unset($_SESSION["showdefeira"]);
            echo "<script>location.href='index'</script>";
        }

        public function verificar ($email, $senha){
            $dadosUsuario = $this->usuario->getUsuario($email);


            if(empty($dadosUsuario->id)){
                echo "<script>mensagem('Usuario invalido', 'index', 'error');</script>";
            } else if (!password_verify($senha, $dadosUsuario->senha)){
                echo "<script>mensagem('Usuario invalido', 'index', 'error');</script>";
            }else {
                $_SESSION["showdefeira"] = array("id" => $dadosUsuario->id,
                                     "nome" =>$dadosUsuario->nome);
                echo "<script>location.href='index'</script>";
                                     
            }
        }
    }


    
