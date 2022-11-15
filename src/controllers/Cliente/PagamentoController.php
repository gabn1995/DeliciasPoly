<?php

namespace src\controllers\Cliente;

use \core\Controller;
use \src\controllers\Cliente\ViewController;
use \src\ConfigPagamento;
use \src\models\Cliente;
use \src\models\Carrinho;
use \src\models\Pedido;

class PagamentoController extends Controller
{
    public function index()
    {
        //pegar usuário logado
        $token = $_SESSION['token'];
        if ($token) {
            //Pegar o id do carrinho 
            $cliente = Cliente::select()->where('token', $token)->one();
            $carrinho = Carrinho::select()->where('id_cliente', $cliente['id'])->one();
            $produtos_carrinho = json_decode($carrinho['produtos']);

            if ($produtos_carrinho != null) {
                $view = new ViewController();
                $view->rend('pagamento');
            } else {
                $_SESSION['aviso'] = "Adicione produtos ao carrinho!";
                $this->redirect('/#produtos');
            }
        } else {
            $this->redirect('/');
        }
    }

    public function pagamentoAction()
    {
        //pegar os dados
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $celular = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_SPECIAL_CHARS);

        $rua = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_SPECIAL_CHARS);
        $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_SPECIAL_CHARS);
        $complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_SPECIAL_CHARS);
        $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS);
        $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS);
        $estado = filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_SPECIAL_CHARS);
        $cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_SPECIAL_CHARS);

        //dump dos dados
        // echo json_encode($_POST);
        // die();

        if ($nome and $cpf and $email and $celular and $rua and $numero and $complemento and $bairro and $cidade and $estado and $cep) {
            //pegar usuário logado
            $token = $_SESSION['token'];
            if ($token) {
                //Pegar o id do carrinho 
                $cliente = Cliente::select()->where('token', $token)->one();
                $carrinho = Carrinho::select()->where('id_cliente', $cliente['id'])->one();
                $produtos_carrinho = json_decode($carrinho['produtos']);

                //montar os produtos
                $lista_items = [];
                foreach ($produtos_carrinho as $produto) {
                    $item = [];
                    $item = [
                        'description' => $produto->nome,
                        'quantity' => $produto->quant,
                        'item_id' => $produto->id,
                        'price_cents' => $produto->preco * 100
                    ];

                    array_push($lista_items, $item);
                }

                // echo json_encode($produtos_carrinho);
                // die();

                $data = array(
                    'apiKey' => ConfigPagamento::API_KEY,

                    'order_id' => $carrinho['id'], // código interno do lojista para identificar a transacao.

                    //dados do cliente
                    'payer_email' => $email,
                    'payer_name' => $nome, // nome completo ou razao social
                    'payer_cpf_cnpj' => $cpf, // cpf ou cnpj
                    'payer_phone' => $celular, // fixou ou móvel
                    'payer_street' => $rua,
                    'payer_number' => $numero,
                    'payer_complement' => $complemento,
                    'payer_district' => $bairro,
                    'payer_city' => $cidade,
                    'payer_state' => $estado, // apenas sigla do estado
                    'payer_zip_code' => $cep,
                    //dados do cliente

                    'notification_url' => 'https://mysite.com/notification/paghiper/',
                    'discount_cents' => '0', // em centavos
                    'shipping_price_cents' => '0', // em centavos
                    'shipping_methods' => 'PAC',
                    'fixed_description' => true,
                    'type_bank_slip' => 'boletoA4', // formato do boleto
                    'days_due_date' => '5', // dias para vencimento do boleto
                    'late_payment_fine' => '2', // Percentual de multa após vencimento.
                    'per_day_interest' => true, // Juros após vencimento.

                    'items' => $lista_items,

                    // 'items' => array(
                    //     array(
                    //         'description' => 'piscina de bolinha',
                    //         'quantity' => '1',
                    //         'item_id' => '1',
                    //         'price_cents' => '1012'
                    //     ), // em centavos
                    //     array(
                    //         'description' => 'pula pula',
                    //         'quantity' => '2',
                    //         'item_id' => '1',
                    //         'price_cents' => '2000'
                    //     ), // em centavos
                    //     array(
                    //         'description' => 'mala de viagem',
                    //         'quantity' => '3',
                    //         'item_id' => '1',
                    //         'price_cents' => '4000'
                    //     ), // em centavos
                    // ),
                );

                $data_post = json_encode($data);
                $url = "https://api.paghiper.com/transaction/create/";
                $mediaType = "application/json"; // formato da requisição
                $charSet = "UTF-8";
                $headers = array();
                $headers[] = "Accept: " . $mediaType;
                $headers[] = "Accept-Charset: " . $charSet;
                $headers[] = "Accept-Encoding: " . $mediaType;
                $headers[] = "Content-Type: " . $mediaType . ";charset=" . $charSet;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_post);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $result = curl_exec($ch);
                $json = json_decode($result, true);
                // captura o http code
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($httpCode == 201) :
                    //salvar no database
                    $this->salvar_pedido($cliente, $produtos_carrinho, $data, $result);
                    // CÓDIGO 201 SIGNIFICA QUE O BOLETO FOI GERADO COM SUCESSO
                    echo $result;
                    // Exemplo de como capturar a resposta json
                    $transaction_id = $json['create_request']['transaction_id'];
                    $url_slip = $json['create_request']['bank_slip']['url_slip'];
                    $digitable_line = $json['create_request']['bank_slip']['digitable_line'];
                else :
                    echo $result;
                endif;
            }
        }
    }

    private function salvar_pedido($cliente, $produtos, $dados, $result)
    {
        $result = json_decode($result);
        $resultado = $result->create_request;

        Pedido::insert([
            'id_cliente' => $cliente['id'],
            'produtos' => json_encode($produtos),
            'nome' => $dados['payer_name'],
            'cpf' => $dados['payer_cpf_cnpj'],
            'email' => $dados['payer_email'],
            'celular' => $dados['payer_phone'],
            'cep' => $dados['payer_zip_code'],
            'estado' => $dados['payer_state'],
            'cidade' => $dados['payer_city'],
            'bairro' => $dados['payer_district'],
            'rua' => $dados['payer_street'],
            'numero' => $dados['payer_number'],
            'complemento' => $dados['payer_complement'],
            'preco_frete' => $dados['shipping_price_cents']/100,
            'preco_compra' => $resultado->value_cents/100,
            'id_transacao' => $resultado->transaction_id,
            'data_criacao' => $resultado->created_date,
            'data_vencimento' => $resultado->due_date,
            'codigo_barra' =>$resultado->bank_slip->digitable_line,
            'status' => 'pendente',
            // 'status' => $resultado->status
        ])->execute();
    }
}
