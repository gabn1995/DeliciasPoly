<?php use \src\Config; ?>

<div class="content-wrapper" style="min-height: 212px;">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0">Editar dados do cliente</h1>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">

            <?php
                $cliente = $cliente ?? '';
                if($cliente):
            ?>

            <form method="POST" action="<?php echo Config::BASE_DIR?>/empresa/cliente/editAction/<?php echo $cliente['id']?>">
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" class="form-control"
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
                    <input type="submit" value="Salvar Alterações" class="btn btn-primary">
                </div>
            </form>
            <?php else:?>
                <h5>Cliente inválido</h5>
            <?php endif;?>


          </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->
  