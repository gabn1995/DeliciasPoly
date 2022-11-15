<?php
namespace src\controllers\Cliente;
use \core\Controller;

class ViewController extends Controller {
    
    public function rend($pagina, $nome_variavel=null, $variavel=null){
        //renderizar tela
        $this->render('./Cliente/partials/header');
        $this->render('./Cliente/'.$pagina, [
            $nome_variavel => $variavel
        ]);
        $this->render('./Cliente/partials/footer');
    }

}
