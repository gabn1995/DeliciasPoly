<?php use \src\Config;?>

<div class="body-js container ">
    <br>
    <h1>Faça Login</h1>
    <br><br>
    <form method="POST" action="<?php echo Config::BASE_DIR;?>/login">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control">
        </div><br>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" class="form-control">
        </div><br><br>
        <div class="form-group">
            <a href="<?php echo Config::BASE_DIR;?>/cadastro">Ainda não tem conta? Cadastre-se</a>
        </div>
        <div class="form-group">
            <input type="submit" value="Fazer Login" class="btn btn-primary">
        </div>
    </form>
</div>
