<?php

namespace src\controllers\Empresa;

use \src\Config;
use \core\Controller;
use \src\models\Recibo;

class ReciboController extends Controller
{

    public function pegarRecibo($id_pedido)
    {
        // echo $id_pedido['id'];
        $token = $_SESSION['empresa_token'];

        if($token){
            $recibo = Recibo::select()->where('id_pedido', $id_pedido['id'])->one();
            // echo json_encode($recibo);
            // die();
            
            $recibo_url = $recibo['arquivo'];

            $url = Config::BASE_DIR."/assets/recibos/$recibo_url.pdf";
            echo $url;

        }

    }

}
