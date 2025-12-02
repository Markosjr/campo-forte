<div class="container">

    <div class="card p-3 mb-3">
        Olá, seja bem-vindo <?= $_SESSION['cliente']['nome'] ?>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <h2>Produtos em Destaque</h2>
        </div>

        <div class="card-body">

            <div class="row justify-content-center">

                <?php
                $urlProduto = "http://localhost/show-de-feira/public/apis/produto.php?destaque=S";
                $dadosProduto = json_decode(file_get_contents($urlProduto), true);

                foreach ($dadosProduto as $dados) {
                ?>

                    <div class="col-12 col-md-4 col-lg-3 mb-4 d-flex justify-content-center">
                        <div class="card shadow-sm"
                            style="border-radius: 8px; width: 18rem; text-align: center;">


                            <img src="http://localhost/show-de-feira/public/arquivos/<?= $dados['imagem'] ?>"
                                class="img-fluid p-3"
                                style="height: 180px; object-fit: contain;">

                            <div class="card-body">


                                <h5 style="font-weight: bold;">
                                    <?= $dados['nome'] ?>
                                </h5>


                                <a href="produto/detalhes/<?= $dados['id'] ?>"
                                    class="btn btn-success mt-3" style="width: 80%;">
                                    <i class="fas fa-search"></i> Detalhes do Produto
                                </a>


                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>


        </div>
    </div>

</div>