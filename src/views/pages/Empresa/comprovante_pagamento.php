<!DOCTYPE html>
<html lang="pt-br">
<?php 
    use src\Config;

    $dados = $dados ?? [];
    ob_start();
?>

<head>
    <meta charset="UTF-8">
    <title>Recibo</title>
</head>
<body>
    <p>BANCO BRADESCO</p>
    <p>AUTO - ATENDIMENTO  -  <span><?php echo $dados['data_pagamento']; ?></span></p>
    <p>78857693</p>
    <br><br>
    <h3>COMPROVANTE DE PAGAMENTO</h3>
    <br>
    <p>CLIENTE: <span><?php echo $dados['nome']; ?></span></p>
    <p>CPF: <span><?php echo $dados['cpf']; ?></span></p>
    <hr>
    <p>Convenio - <span>  DELÍCIAS POLLY  </span></p>
    <p>Códido de barra - <span><?php echo $dados['codigo_barra']; ?></span></p>
    <br>
    <p>Data de pagamento  - <span><?php echo $dados['data_pagamento']; ?></span></p>
    <p>Valor em dinheiro - <span><?php echo $dados['valor']; ?></span></p>
    <p>Valor em cheque - <span>R$ 0,00</span></p>
    <p>Valor Total  - <span><?php echo $dados['valor']; ?></span></p>
    <hr>
    <p>DOCUMENTO - <span><?php echo $dados['id_documento']; ?></span></p>
    <p>AUTENTICAÇÃO - <span><?php echo $dados['token']; ?></span></p>

</body>
</html>

<?php 
    $html = ob_get_contents();
    ob_end_clean();

    require '../vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);
    $mpdf->Output($dados['arquivo'].'.pdf', 'F');

    $origem = $_SERVER[ 'DOCUMENT_ROOT' ].Config::BASE_DIR.'/'.$dados['arquivo'].'.pdf';
    $destino = $_SERVER[ 'DOCUMENT_ROOT' ].Config::BASE_DIR.'/assets/recibos/'.$dados['arquivo'].'.pdf';

    if(file_exists($origem)){
        copy($origem, $destino);
        unlink($origem);
    }

?>