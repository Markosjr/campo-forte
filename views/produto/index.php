<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

<?php

    if (!empty($id)) {
        $dados = $this->produto->editar($id);
    }

    $id = $dados->id ?? NULL;
    $nome = $dados->nome ?? NULL;
    $descricao = $dados->descricao ?? NULL;
    $destaque = $dados->destaque ?? NULL;
    $ativo = $dados->ativo ?? NULL;
    $imagem = $dados->imagem ?? NULL;
    $categoria_id = $dados->categoria_id ?? NULL;

    $valor = $dados->valor ?? 0;   
    $valor = number_format($valor, 2, ",", "."); 

?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h2>Cadastro de Produtos</h2>
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

            <form name="formCadastro" method="post" action="produto/salvar" enctype="multipart/form-data" data-parsley-validate="">

                <div class="row">
                    <div class="col-12 col-md-1">
                        <label for="id">ID:</label>
                        <input type="text" readonly name="id" id="id" class="form-control" value="<?= $id ?>">
                    </div>

                    <div class="col-12 col-md-8">
                        <label for="nome">Nome do Produto:</label>
                        <input type="text" name="nome" id="nome" class="form-control" required data-parsley-required-message="Digite o nome" value="<?= $nome ?>">
                    </div>

                    <div class="col-12 col-md-3">
                        <label for="categoria_id">Categoria:</label>
                        <select name="categoria_id" id="categoria_id" required class="form-control" data-parsley-required-message="Selecione uma categoria">
                            <option value=""></option>
                            <?php
                                $dadosCategoria = $this->produto->listarCategoria();
                                foreach ($dadosCategoria as $cat) {
                                    ?>
                                    <option value="<?= $cat->id ?>"><?= $cat->descricao ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                        <script>
                            $("#categoria_id").val(<?= $categoria_id ?>);
                        </script>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-12 col-md-12">
                        <label for="descricao">Descrição do Produto:</label>
                        <textarea name="descricao" id="descricao" class="form-control" required data-parsley-required-message="Digite uma descrição"><?= $descricao ?></textarea>
                    </div>
                </div>

                <br>

                <div class="row">

                    <div class="col-12 col-md-6">
                        <label for="imagem">Selecione uma foto JPG:</label>
                        <input type="file" name="imagem" id="imagem" class="form-control" accept=".jpg">

                        <input type="hidden" name="imagem_atual" value="<?= $imagem ?>">

                        <?php if (!empty($imagem)) : ?>
                            <br>
                        <img src="http://localhost/show-de-feira/public/arquivos/<?= $imagem ?>" width="150">
                        <?php endif; ?>
                    </div>

                    <div class="col-12 col-md-2">
                        <label for="valor">Valor:</label>
                        <input type="text" name="valor" id="valor" class="form-control" required data-parsley-required-message="Digite o valor" value="<?= $valor ?>">
                    </div>

                    <div class="col-12 col-md-2">
                        <label for="destaque">Destaque:</label>
                        <select name="destaque" id="destaque" required class="form-control">
                            <option value=""></option>
                            <option value="S">Sim</option>
                            <option value="N">Não</option>
                        </select>
                        <script>
                            $("#destaque").val("<?= $destaque ?>");
                        </script>
                    </div>

                    <div class="col-12 col-md-2">
                        <label for="ativo">Ativo:</label>
                        <select name="ativo" id="ativo" required class="form-control">
                            <option value=""></option>
                            <option value="S">Sim</option>
                            <option value="N">Não</option>
                        </select>
                        <script>
                            $("#ativo").val("<?= $ativo ?>");
                        </script>
                    </div>

                </div>

                <br>

                <button type="submit" class="btn btn-success float-end">
                    <i class="fas fa-check"></i> Salvar/Alterar
                </button>

            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#descricao').summernote({
        height: 200
    });
});

$("#valor").maskMoney({ thousand:'.', decimal:',' });
</script>
