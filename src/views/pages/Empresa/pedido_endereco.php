<?php

use \src\Config; ?>

<div class="content-wrapper" style="min-height: 212px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Endereço do pedido</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <?php
            $pedido = $pedido ?? '';
            ?>

            <form>
                <div class="form-group">
                    <label for="cep">CEP:</label>
                    <input type="text" id="cep" name="cep" class="form-control" disabled 
                    value="<?php echo $pedido['cep'];?>">
                </div>
                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <input type="text" id="estado" name="estado" class="form-control" disabled 
                    value="<?php echo $pedido['estado'];?>">
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade:</label>
                    <input type="text" id="cidade" name="cidade" class="form-control" disabled 
                    value="<?php echo $pedido['cidade'];?>">
                </div>
                <div class="form-group">
                    <label for="bairro">Bairro:</label>
                    <input type="email" id="bairro" name="bairro" class="form-control" disabled 
                    value="<?php echo $pedido['bairro'];?>">
                </div>
                <div class="form-group">
                    <label for="rua">Rua:</label>
                    <input type="text" id="rua" name="rua" class="form-control" disabled 
                    value="<?php echo $pedido['rua'];?>">
                </div>
                <div class="form-group">
                    <label for="numero">Número:</label>
                    <input type="text" id="numero" name="numero" class="form-control" disabled 
                    value="<?php echo $pedido['numero'];?>">
                </div>
                <div class="form-group">
                    <label for="complemento">Complemento:</label>
                    <input type="text" id="complemento" name="complemento" class="form-control" disabled 
                    value="<?php echo $pedido['complemento'];?>">
                </div>
                <div class="form-group">
                    <a href="<?php echo Config::BASE_DIR;?>/empresa/pedidos" class="btn btn-primary">Voltar</a>
                </div>
                <br>
            </form>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
</div>
<!-- /.content-wrapper -->