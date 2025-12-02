<?php
$img = "http://localhost/show-de-feira/public/arquivos/";
?>

<div class="card">
    <div class="card-header">
        <h2>Carrinho de Compras</h2>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td> Imagem </td>
                    <td> Nome do Produto </td>
                    <td> Quantidade </td>
                    <td> Valor unitario </td>
                    <td> Valor total </td>
                    <td> Excluir </td>
                </tr>
            </thead>
            <tbody>

                <?php 
                
                $total = 0;
                


                if (!empty($_SESSION["carrinho"])) {

                    foreach ($_SESSION["carrinho"] as $dados) {
                        $total = $total + ($dados ["qtde"] * $dados["valor"]);
                    ?>
                    <tr>
                        <td><img src="<?= $img . $dados["imagem"] ?>" width="130px"></td>
                        <td><?= $dados["nome"] ?></td>
                        <td>
                            <input type="number" value="<?= $dados["qtde"]?>" class="form-control" onblur="somarQuantidade (this.value, <?= $dados["id"]?>">
                        </td>
                        <td><?= number_format($dados["valor"], 2, ",", ".") ?></td>
                        <td><?= number_format($dados["qtde"] * $dados["valor"], 2, ",", ".") ?></td>

                        <td>
                            <a href="carrinho/excluir/<?= $dados["id"]?>" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php ; 
                }
            }
                ?>
            </tbody>
        </table>
                    <p class="float-start">
                        <a href="carrinho/limpar" class="btn btn-warning">
                            Limpar Carrinho
                        </a>
                        <a href="carrinho/finalizar" class="btn btn-success">
                            Finalizar compra
                        </a>
                    </p>
                    <p class="float-end valor">
                        R$ <?= number_format($total, 2, ",", ".") ?>
                    </p>
    </div>
</div>
<script>
    somarQuantidade = function(qtde, id) {
        $.get("somar.php", {qtde:qtde, id:id}, function(dados) {
            if (dados == "" ) window.location.reload();
            else alert(dados);
        })
    }
</script>