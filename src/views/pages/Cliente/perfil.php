<?php use \src\Config;?>
<?php if(empty($_SESSION['token'])){die();} ?>

<div class="body-js container ">
    <br>
    <h1>Perfil</h1>
    <br>
    <form method="POST" action="<?php echo Config::BASE_DIR;?>/perfilAction">
    <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" disabled=disabled class="form-control"
            value="<?php
            echo $cliente['cpf'];
            ?>">
        </div>
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" value="<?php
            echo $cliente['nome'];
            ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" 
            value="<?php
            echo $cliente['email'];
            ?>">
        </div>
        <div class="form-group">
            <label for="celular">Celular:</label>
            <input type="text" id="celular" name="celular" class="form-control" 
            value="<?php
            echo $cliente['celular'];
            ?>">
        </div>
        <div class="form-group">
            <a href="<?php echo Config::BASE_DIR;?>/alterarSenha">Alterar senha</a>
        </div>
        <div class="form-group">
            <input type="submit" value="Salvar Alterações" class="btn btn-primary">
        </div>
    </form>
</div>