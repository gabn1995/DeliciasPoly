<?php use \src\Config;?>

<div class="content-wrapper" style="min-height: 212px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pedidos</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <table class="table table-head-fixed text-nowrap table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Id</th>
                        <th>Cliente</th>
                        <th>Produtos</th>
                        <th>Endereço</th>
                        <th>Frete</th>
                        <th>Valor da compra</th>
                        <th>Data da compra</th>
                        <th>Vencimento</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $pedidos = $pedidos ?? [];
                    foreach ($pedidos as $pedido) :
                    ?>
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <td><?php echo $pedido['status']; ?></td>
                            <td><?php echo $pedido['id']; ?></td>
                            <td>
                                <a href="<?php echo Config::BASE_DIR;?>/empresa/pedido/cliente/<?php echo $pedido['id'];?>">
                                    <?php echo $pedido['id_cliente']; ?>
                                </a>
                            </td>
                            <td><a href="<?php echo Config::BASE_DIR;?>/empresa/pedido/produto/<?php echo $pedido['id'];?>">produtos</a></td>
                            <td>
                                <a href="<?php echo Config::BASE_DIR;?>/empresa/pedido/endereco/<?php echo $pedido['id'];?>">
                                    <?php echo $pedido['cep']; ?>
                                </a>
                            </td>
                            <td><?php echo $pedido['preco_frete']; ?></td>
                            <td><?php echo $pedido['preco_compra']; ?></td>
                            <td><?php echo $pedido['data_criacao']; ?></td>
                            <td><?php echo $pedido['data_vencimento']; ?></td>

                            <?php if($pedido['status'] == 'pago'):; ?>
                                <td style="width: 70px">
                                    <a href="<?php echo Config::BASE_DIR; ?>/empresa/pedido/finalizar/<?php echo $pedido['id']; ?>" class="btn-app bg-transparent">
                                        <img src="<?php echo Config::BASE_DIR;?>/assets/img/finalizado.png" alt="" style="width: 20px;">
                                    </a>
                                    <a href="<?php echo Config::BASE_DIR; ?>/empresa/recibo/<?php echo $pedido['id']; ?>" class="btn-app bg-transparent recibo-js" >
                                        <img src="<?php echo Config::BASE_DIR;?>/assets/img/recibo.png" alt="" style="width: 20px;">
                                    </a>
                                </td>
                            <?php endif; ?>

                            <?php if($pedido['status'] == 'pendente'):; ?>
                                <td style="width: 70px">
                                    <a href="<?php echo Config::BASE_DIR; ?>/empresa/pedido/pagar/<?php echo $pedido['id']; ?>" class="btn-app bg-transparent">
                                        <img src="<?php echo Config::BASE_DIR;?>/assets/img/pago.png" alt="" style="width: 20px;">
                                    </a>
                                </td>
                            <?php endif; ?>

                            <?php if($pedido['status'] == 'finalizado'):; ?>
                                <td style="width: 70px">
                                    <a href="<?php echo Config::BASE_DIR; ?>/empresa/pedido/delete/<?php echo $pedido['id']; ?>" class="btn-app bg-transparent">
                                        <img src="<?php echo Config::BASE_DIR;?>/assets/img/trash.png" alt="" style="width: 20px;">
                                    </a>
                                </td>
                            <?php endif; ?>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
</div>
<!-- /.content-wrapper -->