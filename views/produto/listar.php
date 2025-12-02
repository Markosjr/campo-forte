<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h2>Listagem de Produtos</h2>
            </div>
            <div class="float-end">
                <a href="produto" class="btn btn-success">
                    <i class="fas fa-file"></i> Adicionar Novo
                </a>
                <a href="produto/listar" class="btn btn-success">
                    <i class="fas fa-search"></i> Listar
                </a>
            </div>
        </div>

        <div class="card-body">

            <table class="table table-striped table-bordered">

                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Imagem</td>
                        <td>Nome do Produto</td>
                        <td>Valor</td>
                        <td>Ativo</td>
                        <td>Destaque</td>
                        <td>Opções</td>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    foreach ($lista as $dados):
                        $valor = number_format($dados->valor, 2, ",", ".");
                        $ativo = ($dados->ativo == 'S') ? "Sim" : "Não";
                        $destaque = ($dados->destaque == 'S') ? "Sim" : "Não";
                    ?>

                        <tr>
                            <td><?= $dados->id ?></td>
                            <td><img src="arquivos/<?= $dados->imagem ?>" width="100px"></td>
                            <td><?= $dados->nome ?></td>
                            <td>R$ <?= $valor ?></td>
                            <td><?= $ativo ?></td>
                            <td><?= $destaque ?></td>
                            <td>
                                <a href="produto/index/<?= $dados->id ?>" class="btn btn-success">
                                    <i class="fas fa-edit"></i>
                                </a>

                

                                <a href="produto/excluir/<?= $dados->id ?>"
                                    class="btn btn-danger"
                                    onclick="return confirm('Deseja realmente excluir?')">
                                    <i class="fas fa-trash"></i>
                                </a>

                            </td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>
        </div>
    </div>
</div>