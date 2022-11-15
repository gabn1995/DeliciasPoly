<?php

use \src\Config; ?>

<div class="content-wrapper" style="min-height: 212px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dados do Cliente</h1>
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
                    <label for="id">Id:</label>
                    <input type="text" id="id" name="id" class="form-control" disabled 
                    value="<?php echo $pedido['id_cliente'];?>">
                </div>
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" class="form-control" disabled 
                    value="<?php echo $pedido['nome'];?>">
                </div>
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" class="form-control" disabled 
                    value="<?php echo $pedido['cpf'];?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" disabled 
                    value="<?php echo $pedido['email'];?>">
                </div>
                <div class="form-group">
                    <label for="celular">Celular:</label>
                    <input type="text" id="celular" name="celular" class="form-control" disabled 
                    value="<?php echo $pedido['celular'];?>">
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