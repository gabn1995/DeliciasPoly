<?php use \src\Config; ?>

<div class="content-wrapper" style="min-height: 212px;">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0">Editar dados do produto</h1>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">

            <?php
                $produto = $produto ?? '';
                if($produto):
            ?>

            <form id="formulario" enctype="multipart/form-data" method="POST" action="<?php echo Config::BASE_DIR; ?>/empresa/produto/editAction/<?php echo $produto['id']; ?>">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" class="form-control" value="<?php
                    echo $produto['nome'];
                    ?>">
                </div>
                <div class="form-group">
                    <label for="preco">Preço:</label>
                    <input type="text" id="preco" name="preco" class="form-control" 
                    value="<?php
                    echo $produto['preco'];
                    ?>">
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria:</label>
                    <input type="text" id="categoria" name="categoria" class="form-control" 
                    value="<?php
                    echo $produto['categoria'];
                    ?>">
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <input type="text" id="descricao" name="descricao" class="form-control" 
                    value="<?php
                    echo $produto['descricao'];
                    ?>">
                </div>
                <div class="form-group">
                    <label for="imagem">Imagem:</label>
                    <input type="file" id="imagem" name="imagem" class="form-control arquivo-imagem-js">
                </div>
                <div class="form-group">
                    <img class="preview-js" src="<?php echo Config::BASE_DIR; ?>/assets/img/produtos/<?php echo $produto['imagem']; ?>.jpg" alt="" width="50px" height="50px">
                </div>
                <div class="form-group">
                    <input type="submit" value="Salvar Alterações" class="btn btn-primary">
                </div>
            </form>
            <?php else:?>
                <h5>Produto inválido</h5>
            <?php endif;?>

          </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->
  