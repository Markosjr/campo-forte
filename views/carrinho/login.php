<div class="card">
    <div class="card-header">
        <h1>Faca seu Login ou Cadastre-se</h1>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <h2>Faca o Login</h2>
                <form name="formLogin" method="post" action="carrinho/logar" data-parsley-validate>
                    <label for="email">Seu email: </label>
                    <input type="email" name="email" id="email" class="form-control" required data-parsley-required-message="Preencha o email" data-parsley-type-message="digite um email valido">

                    <label for="senha">Sua senha:</label>
                    <input type="password" name="senha" id="senha" class="form-control" required data-parsley-required-message="Preencha a senha">

                    <br>
                    <button type="submit" class="btn btn-success">Efetuar Login</button>
                </form>
            </div>
            <div class="col-12 col-md-6">
                <h2>Faca seu Cadastro</h2>
                <form name="formCadastrar" method="post" action="carrinho/Cadastrar" data-parsley-validate>
                    <label for="cli_nome">Seu nome:</label>
                    <input type="text" name="nome" id="cli-nome" class="form-control" required data-parsley-required-message="Preencha o nome">

                    <label for="email">Seu email: </label>
                    <input type="email" name="email" id="cli_email" class="form-control" required data-parsley-required-message="Preencha o email" data-parsley-type-message="digite um email valido">

                    <label for="senha">Sua senha:</label>
                    <input type="password" name="senha" id="cli_senha" class="form-control" required data-parsley-required-message="Preencha a senha">

                    <label for="senhaRedigitada">Redigite sua Senha: </label>
                    <input type="password" name="senhaRedigitada" id="cli_senhaRedigitada" class="form-control" required data-parsley-required-message="Redigite a senha"
                    data-parsley-equalto="#cli_senha" data-parsley-equalto-message="As senhas nao coincidem">

                    <br>
                    <button type="submit" class="btn btn-success">
                        Efetuar Cadastro
                    </button>

                </form>
            </div>
        </div>
    </div>
</div>