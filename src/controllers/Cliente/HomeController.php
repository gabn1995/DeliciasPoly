<?php
namespace src\controllers\Cliente;

use \core\Controller;
use \src\models\Produto;
use \src\controllers\Cliente\ViewController;

class HomeController extends Controller {
    
    public function index() {
        $produtos = Produto::select()->execute();

        $view = new ViewController();
        $view->rend('home', 'produtos', $produtos);
    }

    public function filtro($categoria){
        $view = new ViewController();
        $categorias = array('doce', 'bolo', 'kitFesta');
        $produtos = [];

        if(in_array($categoria['filtro'], $categorias)){
            $produtos = Produto::select()->where('categoria', $categoria)->execute();
            $view->rend('home', 'produtos', $produtos);
        }
        if($categoria['filtro'] === 'todos'){
            $produtos = Produto::select()->execute();
            $view->rend('home', 'produtos', $produtos);
        }

    }

    public function filtroAction($categoria){
        $categorias = array('doce', 'bolo', 'kitFesta');
        $produtos = [];

        if(in_array($categoria['filtro'], $categorias)){
            $produtos = Produto::select()->where('categoria', $categoria)->execute();
            
        }else{
            $produtos = Produto::select()->execute();
        }

        echo json_encode($produtos);
    }


    // public function sobre() {
    //     //$this->render('sobre');

    //     $url = 'https://alunos.b7web.com.br/api/ping';
    //     //$url = "http://localhost/Projetos/DP/public/salvarCarrinho";

    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     //curl_setopt($ch, CURLOPT_POST, 1);
    //     //curl_setopt($ch, CURLOPT_POSTFIELDS, "nome=Gabriel&idade=25");
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //     $resposta = curl_exec($ch);
    //     curl_close($ch);

    //     print_r($resposta);
        
    // }

    // public function sobreP($args) {
    //     print_r($args);
    // }

}