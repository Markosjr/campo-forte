<?php

if (!empty($id)) {
    $dados = $this->usuario->editar($id);
}

$id = $dados->id ?? NULL;
$nome = $dados->nome ?? NULL;
$email = $dados->email ?? NULL;
$telefone = $dados->telefone ?? NULL;
$ativo = $dados->ativo ?? NULL;

?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="float-start">
                <h2> Cadastro de Usuarios </h2>
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
            <form name="formUsuario" method="post" data-parsley-validate="" action="usuario/salvar">
                <div class="row">
                    <div class="col-12 col-md-1">
                        <label for="id">ID:</label>
                        <input type="text" name="id" id="id" class="form-control" readonly value="<?= $id ?>">
                    </div>
                    <div class="col-12 col-md-11">
                        <label for="nome">Nome do Usuario: </label>
                        <input type="text" name="nome" id="nome" class="form-control" value="<?= $nome ?>"
                            required data-parsley-required-message="Preencha o nome">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <label for="email">Digite seu e-mail</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?= $email ?>"
                            data-parsley-required-message="Preencha seu e-mail"
                            data-parsley-type-message="Digite um email valido">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="senha">Digite sua senha: </label>
                        <input type="password" name="senha" id="senha" class="form-control">
                    </div>
                    <div class="col-12 col-md-3">
                        <label for="redigite">Redigite a senha:</label>
                        <input type="password" name="redigite" id="redigite" class="form-control" data-parsley-equalto="#senha" data-parsley-equalto-message="As senhas nao coincidem">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label for="telefone">Telefone</label>
                        <input type="text" name="telefone" id="telefone" class="form-control" required data-parsley-required-message="Digite um telefone" value="<?= $telefone ?>">
                    </div>
                    <div class="col-12 col-md-2">
                        <label for="ativo">Ativo: </label>
                        <select name="ativo" id="ativo" class="form-control" data-parsley-required-message="Selectione ativo">
                            <option value=""></option>
                            <option value="S"> Sim </option>
                            <option value="N"> Não </option>
                        </select>
                        <script>
                            $("#ativo").val("<?= $ativo ?>");
                        </script>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-sucess float-end">
                    <i class="fas fa-check"></i> Salvar/Atualizar
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#telefone").inputmask("(99) 9 9999-9999");
    });
</script>