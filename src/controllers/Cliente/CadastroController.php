<?php
namespace src\controllers\Cliente;

use \core\Controller;
use \src\models\Cliente;
use \src\controllers\Cliente\ViewController;

class CadastroController extends Controller {

    public function cadastro() {
        $view = new ViewController();
        $view->rend('cadastro');
    }

    public function cadastroAction() {
        $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS);
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
        $celular = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_SPECIAL_CHARS);

        if ($cpf and $nome and $email and $senha and $celular) {
            $token = md5(time() . rand(0, 9999));
            $hash = password_hash($senha, PASSWORD_DEFAULT);

            $cliente = Cliente::select()->where('email', $email)->execute();

            if(!$cliente){
                $_SESSION['aviso'] = 'Usuário cadastrado com sucesso';
                
                //inserir cliente no DB
                Cliente::insert([
                    'cpf' => $cpf,
                    'nome' => $nome,
                    'email' => $email,
                    'senha' => $hash,
                    'celular' => $celular,
                    'token' => $token
                ])->execute();

                $this->redirect('/');
            }
            $_SESSION['aviso'] = 'Email já cadastrado ou inválido';
            $this->redirect('/cadastro');
            
        }
        $_SESSION['aviso'] = 'Preencha todos os campos!';
        $this->redirect('/cadastro');
        
    }

}