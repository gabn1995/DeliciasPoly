<?php
namespace src\controllers\Empresa;
use src\models\Cliente;
use \core\Controller;
use \src\controllers\Empresa\ViewController;


class ClienteController extends Controller {
    
    public function listarClientes() {
        $clientes = Cliente::select()->execute();
        
        $view = new ViewController();
        $view->rend('clientes', 'clientes', $clientes);
    }

    public function editarCliente($id){
        $cliente = Cliente::select()->where('id', $id)->one();

        $view = new ViewController();
        $view->rend('clienteEdit', 'cliente', $cliente);
    }

    public function editarActionCliente($id){
        //receber as dados do form
        $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $celular = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_SPECIAL_CHARS);
        //verificar se foi preenchido corretamento os dados
        if ($cpf && $nome && $email && $celular) {
            //verificar se o usuário está logado
            $token = $_SESSION['empresa_token'];
            if($token){
                //salvar os dados no database
                Cliente::update()
                ->set('cpf', $cpf)
                ->set('nome', $nome)
                ->set('email', $email)
                ->set('celular', $celular)
                ->where('id', $id)
                ->execute();
                //mostra mensagem de alterado com sucesso
                $_SESSION['empresa_aviso'] = "Dados alterados com sucesso";
                //redirecionar para home
                $this->redirect('/empresa/clientes');
            }
            
        }
        //se os dados forem inválidos redireciona para mesma página com aviso
        $_SESSION['empresa_aviso'] = "Preencha os dados corretamente";
        $id_cliente  = implode(',', $id);
        $this->redirect("/empresa/cliente/edit/$id_cliente");

    }

    public function deletarCliente($id){
        Cliente::delete()->where('id', $id)->execute();
        //redireciona a página de listar clientes
        $this->redirect('/empresa/clientes');
    }

}
   