<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de controle - Campo-forte</title>

    <base href="http://<?= $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME']; ?>">

    <link rel="stylesheet " href="css/bootstrap.min.css">
    <link rel="stylesheet " href="css/all.min.css">
    <link rel="stylesheet " href="css/sweetalert2.min.css">
    <link rel="stylesheet " href="css/style.css">

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/jquery.inputmask.min.js"></script>
    <script src="js/jquery.maskedinput-1.2.1.js"></script>
    <script src="js/parsley.min.js"></script>
    <script src="js/sweetalert2.js"></script>

    <script>
        mostrarSenha = function() {
            const campo = document.getElementById('senha');
            campo.type = campo.type === 'password' ? 'text' : 'password';
        }

        mensagem = function(msg, url, icone) {
            Swal.fire({
                icon: icone,
                title: msg,
                confirmButtonText: "OK",
            }).then(() => location.href = url);
        }

        excluir = function(id, tabela) {
            Swal.fire({
                icon: "question",
                title: "Deseja realmente excluir este registro?",
                showCancelButton: true,
                confirmButtonText: "Excluir",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = tabela + "/excluir/" + id;
                }
            });
        }
    </script>
</head>

<body>
    <?php

    if ((!isset($_SESSION["showdefeira"])) && (!$_POST)) {

        require "../views/index/login.php";

    } else if ((!isset($_SESSION["showdefeira"])) && ($_POST)) {

        $email = trim($_POST["email"] ?? NULL);
        $senha = trim($_POST["senha"] ?? NULL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>mensagem('Email inválido', 'index', 'error')</script>";
        } else if (empty($senha)) {
            echo "<script>mensagem('Digite a senha', 'index', 'error')</script>";
        } else {

            require "../controllers/IndexController.php";
            $acao = new IndexController();
            $acao->verificar($email, $senha);
        }
    } else {

    ?>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index">
                <img src="images/logo.jpg" alt="Campo Forte" style="width: 120px; height: auto;">

            </a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="index">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="categoria">Categoria</a></li>
                    <li class="nav-item"><a class="nav-link" href="produto">Produto</a></li>
                    <li class="nav-item"><a class="nav-link" href="usuario">Usuario</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="carrinho">
                            <i class="fas fa-shopping-cart"></i>
                        </a></li>
                </ul>

                <div class="ms-auto d-flex align-items-center gap-2">
                    <span class="mr-2">Olá <strong><?= $_SESSION['cliente']['nome']; ?></strong></span>
                    <a href="index/sair" class="btn btn-danger">
                        <i class="fas fa-power-off"></i> Sair
                    </a>
                </div>

            </div>
        </nav>

        <main>
            <?php
         
$url = $_GET["url"] ?? "";
$url = trim($url, "/");

$parts = explode("/", $url);

$controller = $parts[0] ?? "index";
$acao       = $parts[1] ?? "index";
$param1     = $parts[2] ?? NULL;
$param2     = $parts[3] ?? NULL;

$controllerFile = "../controllers/" . ucfirst($controller) . "Controller.php";

if (file_exists($controllerFile)) {

    require $controllerFile;

    $className = ucfirst($controller) . "Controller";

    
    $obj = new $className();

    if (method_exists($obj, $acao)) {

        $obj->$acao($param1, $param2);

    } else {

        require "../views/index/erro.php";

    }

} else {

    require "../views/index/erro.php";

}

            ?>
        </main>

    <?php } ?>

</body>

</html>
