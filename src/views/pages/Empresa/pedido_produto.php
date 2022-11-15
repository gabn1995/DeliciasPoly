<?php

use \src\Config; ?>

<div class="content-wrapper" style="min-height: 212px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Produtos do Pedido</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <?php
            $produtos = $produtos ?? [];
            ?>

            <form>
                <div class="form-group">
                    <a href="<?php echo Config::BASE_DIR;?>/empresa/pedidos" class="btn btn-primary">Voltar</a>
                </div>
                <br>
                <?php foreach($produtos as $produto): ;?>
                    <div style="padding: 10px; border: 1px solid gray;">
                        <div class="form-group">
                            <label for="id">Id:</label>
                            <input type="text" id="id" name="id" class="form-control" disabled 
                            value="<?php echo $produto->id;?>">
                        </div>
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" nome="nome" name="nome" class="form-control" disabled 
                            value="<?php echo $produto->nome;?>">
                        </div>
                        <div class="form-group">
                            <label for="quant">Quantidade:</label>
                            <input type="text" quant="quant" name="quant" class="form-control" disabled 
                            value="<?php echo $produto->quant;?>">
                        </div>
                        <div class="form-group">
                            <label for="preco">Preço:</label>
                            <input type="text" preco="preco" name="preco" class="form-control" disabled 
                            value="<?php echo $produto->preco;?>">
                        </div>
                        <div class="form-group">
                            <label for="imagem">Imagem:</label>
                            <img src="<?php echo Config::BASE_DIR;?>/assets/img/produtos/<?php echo $produto->imagem;?>" alt="" width="50px" height="50px">
                        </div>
                    </div>
                    <br>
                <?php endforeach;?>

            </form>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
</div>
<!-- /.content-wrapper -->