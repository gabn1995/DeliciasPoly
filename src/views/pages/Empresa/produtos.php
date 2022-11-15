<?php

use \src\Config; ?>

<div class="content-wrapper" style="min-height: 212px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Produtos
                    <a href="<?php echo Config::BASE_DIR; ?>/empresa/produto/add">
                        <img src="<?php echo Config::BASE_DIR; ?>/assets/img/mais.png" alt="" width="30px" height="30px">
                    </a>
                    </h1>
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
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Categoria</th>
                        <th>Descrição</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $produtos = $produtos ?? [];
                    foreach ($produtos as $produto) :
                    ?>
                        <tr data-widget="expandable-table" aria-expanded="false">
                            <td><?php echo $produto['id']; ?></td>
                            <td><?php echo $produto['nome']; ?></td>
                            <td><?php echo $produto['preco']; ?></td>
                            <td><?php echo $produto['categoria']; ?></td>
                            <td><?php echo $produto['descricao']; ?></td>
                            <td><?php echo $produto['imagem']; ?></td>
                            <td style="width: 70px">
                                <a href="<?php echo Config::BASE_DIR; ?>/empresa/produto/edit/<?php echo $produto['id']; ?>" class="btn-app bg-transparent">
                                    <img src="<?php echo Config::BASE_DIR; ?>/assets/img/document.png" alt="" style="width: 20px;">
                                </a>
                                <a class="deletar-produto-js" href="<?php echo Config::BASE_DIR; ?>/empresa/produto/delete/<?php echo $produto['id']; ?>" class="btn-app bg-transparent">
                                    <img src="<?php echo Config::BASE_DIR; ?>/assets/img/trash.png" alt="" style="width: 20px;">
                                </a>
                            </td>
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