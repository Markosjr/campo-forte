<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h2> Listagem de Usuarios </h2>
            </div>
            <div class="float-end">
                <a href="usuario" title="Novo" class="btn btn-sucess">
                    <i class="fas fa-file"></i> Novo Registro
                </a>
                <a href="usuario/listar" title="Listar" class="btn btn-success">
                    <i class="fas fa-search"></i> Listar
                </a>
            </div>
        </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nome do Usuario</td>
                            <td>Telefone</td>
                            <td>Opções</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $dadosUsuarios = $this->usuario->Listar();
                            foreach ($dadosUsuarios as $dados) {
                                ?>
                                    <tr>
                                        <td><?= $dados->id?></td>
                                        <td><?= $dados->nome?></td>
                                        <td><?= $dados->telefone?></td>
                                        <td>
                                            <a href="usuario/index/<?= $dados->id ?>" class="btn btn-success">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
        </div>
    </div>