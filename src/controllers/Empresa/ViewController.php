<?php
namespace src\controllers\Empresa;
use \core\Controller;

class ViewController extends Controller {
    
    public function rend($pagina, $nome_variavel=null, $variavel=null){
        //renderizar tela
        $this->render('./Empresa/partials/header');
        $this->render('./Empresa/'.$pagina, [
            $nome_variavel => $variavel
        ]);
        $this->render('./Empresa/partials/footer');
    }

}
