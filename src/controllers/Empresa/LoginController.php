<?php

namespace src\controllers\Empresa;

use \core\Controller;
use \src\models\Cliente;
use \src\models\Empresa;
use \src\controllers\Empresa\ViewController;

class LoginController extends Controller
{

    public function loginAction()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

        if ($email and $senha) {
            $empresa = Empresa::select()->where('email', $email)->one();

            if ($empresa) {
                $status = password_verify($senha, $empresa['senha']);

                if ($status) {
                    $_SESSION['empresa_aviso'] = 'Login Admin feito com sucesso';
                    $_SESSION['empresa_token'] = $empresa['token'];

                    $this->redirect('/empresa/clientes');
                    
                }
            }
            $_SESSION['aviso'] = 'E-mail ou Senha Inválida';
            $this->redirect('./empresa');
        }
        $_SESSION['aviso'] = 'Preencha todos os campos!';
        $this->redirect('/empresa');
    }
}
