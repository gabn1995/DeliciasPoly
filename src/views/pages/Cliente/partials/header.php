<?php use \src\Config;?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,shrink-to-fit=no">
        <link rel ="stylesheet" href = "<?php echo Config::BASE_DIR;?>/assets/css/bootstrap.min.css"/>
        <title>Delícias da Polly</title>
    </head>
<body>

<?php
$statusLogin = 'login';
$logo_usuario = 'login';

if(isset($_SESSION['token']) and isset($_SESSION['nome'])){
    $nome = $_SESSION['nome'];
    $array = str_split($nome);
    $primeiraLetra = $array[0];
    $logo_usuario = strtoupper($primeiraLetra);

    $statusLogin = 'perfil';
}else{
    $logo_usuario = 'login';
}
?>

<input class="base_dir-js" type="hidden" value="<?php echo Config::BASE_DIR;?>">

<header class="fixed-top">
    <div class="navbar navbar-expand-lg navbar-dark bg-dark nav-js">
        <a class="navbar-brand" href="<?php echo Config::BASE_DIR;?>">
            <img src="<?php echo Config::BASE_DIR;?>/assets/img/logo1.png" width="50" height="50" class="d-inline-block align-center" alt="">
            Delícias Polly
        </a>

        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse justify-content-center" id="navbarMenu">
            <div class="navbar-nav">
                <a href="<?php echo Config::BASE_DIR;?>" class="navbar-brand nav-item nav-link active">Home</a>
                <a href="<?php echo Config::BASE_DIR;?>/#produtos" class="navbar-brand nav-item nav-link">Produtos</a>
                <a href="<?php echo Config::BASE_DIR;?>/empresa" class="navbar-brand nav-item nav-link">Empresa</a>
                <?php if(isset($_SESSION['token'])):?>
                    <a href="<?php echo Config::BASE_DIR;?>/sair" class='navbar-brand nav-item nav-link'>Sair</a>
                <?php endif;?>   
            </div>
        </div>
        <div class="">
            <a href="<?php echo Config::BASE_DIR;?>/<?php echo $statusLogin?>">
                <img class="img-fluid d-inline-block align-center" src="<?php echo Config::BASE_DIR;?>/assets/img/letras/<?php echo $logo_usuario;?>.png" width="40" height="40" style="margin-right:10px;padding:5px" alt="">
            </a>
            <a class="btn carrinho-modal-js" data-toggle="modal" data-target="#modal-carrinho">
                <img class="img-fluid d-inline-block align-center" src="<?php echo Config::BASE_DIR;?>/assets/img/carrinho.png" width="40" height="40" alt="">
                <span class="quant_carrinho-js text-white">0</span>
            </a>
        </div>

    </div>
    <!--alerta-->
    <div class="alerta-js">
        <?php
        if(isset($_SESSION['aviso'])){ 
            echo"
                    <div class='alert alert-info alert-dismissible fade show w-100 text-center' role='alert'>
                    $_SESSION[aviso]
                        <button class='close' data-dismiss='alert'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
            ";
            unset($_SESSION['aviso']);
        }
        ?>

        <script>
            setTimeout(function (){
                document.querySelector('.alerta-js').innerHTML = "";
            },3000);
        </script>
    </div>
    <!--alerta-->
    
</header>

<!--
    //verificar se usuário está logado para mostrar carrinho
    //senao redireciona para pagina de login
-->

<!-- Carrinho -->
<div class="modal fade" id="modal-carrinho">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: #9ccbe6;">
            <div class="modal-header">
                <h4 class="modal-title">Meu carrinho</h4>
                <button class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-borderless table-hover">

                    <?php $token = $_SESSION['token'] ?? '';?>
                    <?php if($token){ ?>
                        <tbody class="produtos-modal-js">
                            <!-- os produtos do modal serão mostrados aqui! -->
                        <?php }else{ ?>
                            <tbody>
                            <h5>Faça Login para mostrar os seus produtos</h5>
                        <?php }?>

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <?php if($token){ ?>
                    <a href="<?php echo Config::BASE_DIR;?>/pagamento" class="btn btn-success pagamento-js">Pagamento</a>
                    <button class="btn btn-danger limpar-js" data-dismiss="modal">Limpar</button>
                <?php }else{ ?>
                    <a  href="<?php echo Config::BASE_DIR;?>/login" class="btn btn-success">Login</a>
                <?php } ?>
            </div>
        </div>

    </div>
</div>
<!-- Carrinho -->

<!-- modelo da linha a ser inserida no modal -->
<div class="card-modal-js" style="display: none;">
    <tr>
        <td>
            <img class="imagem-modal-js" src="" width="50px" height="50px" alt="" style="padding: 5px;">
            <span class="nome-modal-js" style="margin-left: 10px;">--</span>
        </td>
        <td class="text-right">
            <div class="btn-group botoes-js">
                <button class="btn btn-secondary diminuir-modal-js">-</button>
                <button class="btn btn-secondary quantidade-modal-js">--</button>
                <button class="btn btn-secondary aumentar-modal-js">+</button>
            </div>
        </td>
    </tr>
</div>
<!-- modelo da linha a ser inserida no modal -->


