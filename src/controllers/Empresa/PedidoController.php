<?php

namespace src\controllers\Empresa;

use \core\Controller;
use \src\controllers\Empresa\ViewController;
use src\models\Pedido;
use src\models\Recibo;

class PedidoController extends Controller
{
    public function listarPedidosTodos()
    {
        $pedidos = Pedido::select()->execute();
        $view = new ViewController();
        $view->rend('pedidos', 'pedidos', $pedidos);
    }


    public function listarPedidos($status)
    {
        $status_aceitos = ['pendentes', 'pagos', 'finalizados'];
        $pedidos = [];

        if (in_array($status['status'], $status_aceitos)) {
            if ($status['status'] == 'pendentes') {
                $filtro = 'pendente';
                $pedidos = Pedido::select()->where('status', $filtro)->execute();
            }
            if ($status['status'] == 'pagos') {
                $filtro = 'pago';
                $pedidos = Pedido::select()->where('status', $filtro)->execute();
            }
            if ($status['status'] == 'finalizados') {
                $filtro = 'finalizado';
                $pedidos = Pedido::select()->where('status', $filtro)->execute();
            }
            $view = new ViewController();
            $view->rend('pedidos', 'pedidos', $pedidos);
        }
    }

    public function pedido_cliente($id_pedido)
    {
        $pedido = Pedido::select()->where('id', $id_pedido)->one();

        $view = new ViewController();
        $view->rend('pedido_cliente', 'pedido', $pedido);
    }

    public function pedido_produto($id_pedido)
    {
        $pedido = Pedido::select()->where('id', $id_pedido)->one();
        $produtos = json_decode($pedido['produtos']);

        $view = new ViewController();
        $view->rend('pedido_produto', 'produtos', $produtos);
    }

    public function pedido_endereco($id_pedido)
    {
        $pedido = Pedido::select()->where('id', $id_pedido)->one();

        $view = new ViewController();
        $view->rend('pedido_endereco', 'pedido', $pedido);
    }

    public function finalizarPedido($id)
    {
        $status = 'finalizado';
        $token = $_SESSION['empresa_token'];

        if ($token) {
            //salvar os dados no database
            Pedido::update()
            ->set('status', $status)
            ->where('id', $id)
            ->execute();
            //mostra mensagem de alterado com sucesso
            $_SESSION['empresa_aviso'] = "Dados alterados com sucesso";
            //redirecionar para home
            $this->redirect('/empresa/pedidos');
        }
    }

    public function deletarPedido($id)
    {
        $token = $_SESSION['empresa_token'];

        if ($token) {
            Pedido::delete()->where('id', $id)->execute();
            //redireciona a página de listar clientes
            $this->redirect('/empresa/pedidos');
        }
    }

    public function pagarPedido($id)
    {
        $status = 'pago';
        $token = $_SESSION['empresa_token'];

        if ($token) {
            //salvar os dados no database
            Pedido::update()
            ->set('status', $status)
            ->where('id', $id)
            ->execute();
            //gerar comprovante
            $this->pagamento($id);
            $this->gerar_comprovante($id);
            //mostra mensagem de alterado com sucesso
            $_SESSION['empresa_aviso'] = "Dados alterados com sucesso";
            //redirecionar para home
            $this->redirect('/empresa/pedidos');
        }
    }

    public function pagamento($id){
        $data_pagamento = date('d/m/Y H:i', strtotime("-5 hours"));
        $token = md5(time() . rand(0, 9999));
        $nome_arquivo = md5(time() . rand(0, 9999));

        Recibo::insert([
            'id_pedido' => $id['id'],
            'data_pagamento' => $data_pagamento,
            'arquivo' => $nome_arquivo,
            'token' => $token
        ])->execute();

    }

    public function gerar_comprovante($id){
        $pedido = Pedido::select()->where('id', $id)->one();
        $recibo = Recibo::select()->where('id_pedido', $id)->one();

        $dados = [
            'data_pagamento' => $recibo['data_pagamento'],
            'nome' => $pedido['nome'],
            'cpf' => $pedido['cpf'],
            'codigo_barra' => $pedido['codigo_barra'],
            'valor' => $pedido['preco_compra'],
            'id_documento' => $recibo['id'],
            'token' => $recibo['token'],
            'arquivo' => $recibo['arquivo'],
        ];

        $this->render('./Empresa/comprovante_pagamento', [
            'dados' => $dados
        ]);

    }
}
