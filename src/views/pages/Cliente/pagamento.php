<?php
//require_once "./../src/ConfigPagamento.php";
use src\Config;
use src\ConfigPagamento;
$pagamento = new ConfigPagamento();
?>

<div class="body-js container">
    <input type="hidden" name="endereco" id="endereco" value="<?php echo Config::BASE_DIR; ?>">
    <br>
    <input type="checkbox" name="boleto" id="boleto" checked>
    <label for="boleto">Boleto</label>
    <br>
    <form class="form_pagamento" method="POST" action="<?php echo Config::BASE_DIR;?>/pagamentoAction">
        <h3>1 - Dados Cadastrais</h3>
        <div class="form-group">
            <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="nome" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="celular">Celular:</label>
            <input type="text" id="celular" name="celular" class="form-control" required>
        </div>
        <h3>2 - Endereço</h3>
        <div class="form-group">
            <label for="cep">CEP:</label>
            <input type="text" id="cep" name="cep" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <input type="text" id="uf" name="uf" class="form-control" required disabled>
        </div>
        <div class="form-group">
            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" class="form-control" required disabled>
        </div>
        <div class="form-group">
            <label for="bairro">Bairro:</label>
            <input type="text" id="bairro" name="bairro" class="form-control" required disabled>
        </div>
        <div class="form-group">
            <label for="rua">Rua:</label>
            <input type="text" id="rua" name="rua" class="form-control" required disabled>
        </div>
        <div class="form-group">
            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="complemento">Complemento:</label>
            <input type="text" id="complemento" name="complemento" class="form-control" required>
        </div>
        <input id="submit" type="submit" class="btn-success" value="Gerar Boleto">
    </form>


    <!-- <button onclick="pagamento()">Pagar</button>
    <span class="endereco" data-endereco="<?php echo $pagamento->URL; ?>"></span> -->
    
</div>
