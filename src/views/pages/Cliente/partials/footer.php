<?php use \src\Config;?>

    <footer class="p-3 bg-dark text-white sticky-bottom" style="margin-top: 20px;">
        <div class="container-fluid">
            <div class="text-center">
                <h4>Siga-nos nas redes sociais</h4>
            </div>
            <div class="d-flex justify-content-center">
                <a href=""><img src="<?php echo Config::BASE_DIR;?>/assets/img/logo_instagran.png" alt="" width="60px"></a>
                <a href=""><img src="<?php echo Config::BASE_DIR;?>/assets/img/logo_facebook.png" alt="" width="60px"></a>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="<?php echo Config::BASE_DIR;?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo Config::BASE_DIR;?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="<?php echo Config::BASE_DIR;?>/assets/js/jquery.mask.js"></script>
    <script type="text/javascript" src="<?php echo Config::BASE_DIR;?>/assets/js/mask.js"></script>
    <script type="text/javascript" src="<?php echo Config::BASE_DIR; ?>/assets/js/pagamento.js"></script>
    <script type="module" src="<?php echo Config::BASE_DIR;?>/assets/js/script_cliente.js"></script>
</body>
</html>