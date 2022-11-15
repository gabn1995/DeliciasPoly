<?php use \src\Config;?>

<div class="body-js container ">
    <br>
    <h1>Alterar Senha</h1>
    <br>
    <form method="POST" action="<?php echo Config::BASE_DIR;?>/alterarSenhaAction">
        <div class="form-group">
            <label for="senha_antiga">Digite senha antiga:</label>
            <input type="password" id="senha_antiga" name="senha_antiga" class="form-control">
        </div><br>
        <div class="form-group">
            <label for="senha_nova">Digite senha nova:</label>
            <input type="password" id="senha_nova" name="senha_nova" class="form-control">
        </div><br>
      
        <div class="form-group">
            <label for="senha_nova_confirmar">Confirme senha nova:</label>
            <input type="password" id="senha_nova_confirmar" name="senha_nova_confirmar" class="form-control">
        </div><br>
        <div class="form-group">
            <input type="submit" value="Alterar senha" class="btn btn-primary">
        </div>
    </form>
</div>
