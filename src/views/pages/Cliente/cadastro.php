<?php use \src\Config;?>

<div class="body-js container ">
    <br>
    <h1>Cadastre-se</h1>
    <br>
    <form method="POST" action="<?php echo Config::BASE_DIR;?>/cadastro">
    <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" class="form-control">
        </div>
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" class="form-control ">
        </div>
        <div class="form-group">
            <label for="celular">Celular:</label>
            <input type="text" id="celular" name="celular" class="form-control">
        </div>
        <div class="form-group">
            <a href="<?php echo Config::BASE_DIR;?>/login">Já tem conta? Faça Login</a>
        </div>
        <div class="form-group">
            <input type="submit" value="Cadastrar" class="btn btn-primary enviar-mask">
        </div>
    </form>
</div>