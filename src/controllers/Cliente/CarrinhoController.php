<?php
namespace src\controllers\Cliente;

use \core\Controller;
use \src\models\Cliente;
use \src\models\Carrinho;

class CarrinhoController extends Controller {
    
    public function salvarCarrinho(){
        //verifica se o usuário está logado e pega o carrinho do sistema do usuário
        $token = $_SESSION['token'] ?? '';

        if($token){
            $cart = $_POST['cart'] ?? '';
            $produtos = json_encode($cart);

            $cliente = Cliente::select()->where('token', $token)->one();
            $carrinho = Carrinho::select()->where('id_cliente', $cliente['id'])->execute();

            if(count($carrinho)){
                Carrinho::update()
                ->set('produtos', $produtos)
                ->where('id_cliente', $cliente['id'])
                ->execute();
            }else{
                Carrinho::insert([
                    'id_cliente' => $cliente['id'],
                    'produtos' => $produtos
                ])->execute();
            }
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
        
    }

    public function lerCarrinho(){
        $token = $_SESSION['token'];

        if($token){
            $cliente = Cliente::select()->where('token', $token)->one();
            $carrinho = Carrinho::select()->where('id_cliente', $cliente['id'])->one();

            if(count($carrinho)){
                echo $carrinho['produtos'];
            }
        }else{
            $carrinho = [];
            echo json_encode($carrinho);
        }

    }

    public function limparCarrinho(){
        $token = $_SESSION['token'];

        if($token){
            $cliente = Cliente::select()->where('token', $token)->one();
            if($cliente){
                $carrinho = Carrinho::select()->where('id_cliente', $cliente['id'])->one();
                if($carrinho){
                    Carrinho::update()
                    ->set('produtos', [])
                    ->where('id_cliente', $cliente['id'])
                    ->execute();

                    // $_SESSION['aviso'] = 'Carrinho vazio!';
                    // $this->redirect('/#produtos');
                }
            }
        }
    }

}

