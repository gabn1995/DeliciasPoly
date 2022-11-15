<?php use \src\Config;?>

    <div class="content-wrapper" style="min-height: 212px;">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Clientes</h1>
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
                            <th>Cpf</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Celular</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $clientes = $clientes ?? [];
                        foreach ($clientes as $cliente) :
                        ?>
                            <tr data-widget="expandable-table" aria-expanded="false">
                                <td><?php echo $cliente['id']; ?></td>
                                <td><?php echo $cliente['cpf']; ?></td>
                                <td><?php echo $cliente['nome']; ?></td>
                                <td><?php echo $cliente['email']; ?></td>
                                <td><?php echo $cliente['celular']; ?></td>
                                <td style="width: 70px">
                                    <a href="<?php echo Config::BASE_DIR; ?>/empresa/cliente/edit/<?php echo $cliente['id']; ?>" class="btn-app bg-transparent">
                                        <img src="<?php echo Config::BASE_DIR;?>/assets/img/document.png" alt="" style="width: 20px;">
                                    </a>
                                    <a class="deletar-cliente-js" href="<?php echo Config::BASE_DIR; ?>/empresa/cliente/delete/<?php echo $cliente['id']; ?>" class="btn-app bg-transparent">
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