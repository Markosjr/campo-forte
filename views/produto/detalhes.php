<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Detalhes do Produto</h2>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-md-4">
                    <img src="../public/arquivos/<?= $produto->imagem ?>"
                        class="img-fluid rounded" alt="">
                </div>

                <div class="col-md-8">

                    <h3><?= $produto->nome ?></h3>

                    <p><?= nl2br($produto->descricao) ?></p>

                    <p><strong>Valor:</strong>
                        R$ <?= number_format($produto->valor, 2, ",", ".") ?>
                    </p>

                    <p><strong>Destaque:</strong>
                        <?= ($produto->destaque == "S") ? "Sim" : "Não" ?>
                    </p>


                    <div class="mt-4">

                        <a href="carrinho/adicionar/<?= $produto->id ?>"
                            class="btn btn-success" style="margin-right: 10px;">
                            <i class="fas fa-cart-plus"></i> Adicionar ao Carrinho
                        </a>

                        <a href="../public/index" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>