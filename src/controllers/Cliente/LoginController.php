<?php
namespace src\controllers\Cliente;

use \core\Controller;
use \src\models\Cliente;
use \src\controllers\Cliente\ViewController;

class LoginController extends Controller {

    public function sair(){
        unset($_SESSION['token']);
        $_SESSION['aviso'] = 'Logout feito com sucesso';
        $this->redirect('/');
    }

    public function login() {
        $view = new ViewController();
        $view->rend('login');
    }

    public function loginAction() {
        $email = filter_input(INPUT_POST, 'email',FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha',FILTER_SANITIZE_SPECIAL_CHARS);

        if($email and $senha){
            $cliente = Cliente::select()->where('email',$email)->one();

            if($cliente){
                $status = password_verify($senha, $cliente['senha']);
    
                if($status){
                    $_SESSION['aviso'] = 'Login feito com sucesso';
                    $_SESSION['token'] = $cliente['token'];
                    $_SESSION['nome'] = $cliente['nome'];
                    $this->redirect('/');
                    
    
                }

            $_SESSION['aviso'] = 'E-mail ou Senha Inválida';
            $this->redirect('/login');
            
    
            }
        }
        $_SESSION['aviso'] = 'Preencha todos os campos!';
        $this->redirect('/login');
    }

}