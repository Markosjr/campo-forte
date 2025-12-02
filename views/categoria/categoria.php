<?php require_once "../models/Categoria.php"; ?>
<?php $categorias = Categoria::listar(); ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Cadastro de Categorias</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCategoria">
            Nova Categoria
        </button>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descrição da Categoria</th>
                        <th width="120">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $item): ?>
                        <tr>
                            <td><?= $item->id ?></td>
                            <td><?= $item->descricao ?></td>

                            <td>
                                <button class="btn btn-sm btn-warning" 
                                    onclick="editarCategoria('<?= $item->id ?>', '<?= $item->descricao ?>')">
                                    Editar
                                </button>

                                <button class="btn btn-sm btn-danger" 
                                    onclick="excluirCategoria(<?= $item->id ?>)">
                                    Excluir
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalCategoria" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <form method="POST" action="categoria/salvar">

                <div class="modal-header">
                    <h5 class="modal-title">Categoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id" name="id">

                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome da Categoria</label>
                        <input type="text" id="nome" name="nome" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
function editarCategoria(id, nome) {
    document.getElementById('id').value = id;
    document.getElementById('nome').value = nome;

    var modal = new bootstrap.Modal(document.getElementById('modalCategoria'));
    modal.show();
}

function excluirCategoria(id) {
    if (confirm("Deseja excluir esta categoria?")) {
        window.location = "categoria/excluir/" + id;
    }
}
</script>
