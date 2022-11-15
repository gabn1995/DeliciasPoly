<?php

namespace src\controllers\Empresa;

use \core\Controller;
use \src\controllers\Cliente\ViewController;

class HomeController extends Controller
{

    public function index()
    {
        $view = new ViewController();
        $view->rend('login_empresa');
    }

    public function home()
    {
        $this->redirect('/empresa/pedidos');
    }

    public function sair()
    {
        unset($_SESSION['empresa_token']);
        $_SESSION['aviso'] = 'Logout feito com sucesso';

        $this->redirect('/');
    }
}
