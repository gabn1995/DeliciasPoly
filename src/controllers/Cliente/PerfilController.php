<?php
namespace src\controllers\Cliente;

use \core\Controller;
use \src\models\Cliente;
use \src\controllers\Cliente\ViewController;

class PerfilController extends Controller {

    public function perfil() {
        $token = $_SESSION['token'] ?? '';

        //ler carrinho e usuario pelo token no BD
        $cliente = Cliente::select()->where('token', $token)->one();
        
        if($cliente){
            $view = new ViewController();
            $view->rend('perfil', 'cliente', $cliente);
        }else{
            $this->redirect('/');
        }
    }

    public function perfilAction() {
        //receber as dados do form
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $celular = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_SPECIAL_CHARS);
        //verificar se foi preenchido corretamento os dados
        if ($nome && $email && $celular) {
            //verificar se o usuário está logado
            $token = $_SESSION['token'];
            if($token){
                //pegar o cliente que está logado
                $cliente = Cliente::select()->where('token', $token)->one();
                //salvar os dados no database
                Cliente::update()
                ->set('nome', $nome)
                ->set('email', $email)
                ->set('celular', $celular)
                ->where('id', $cliente['id'])
                ->execute();
                //mostra mensagem de alterado com sucesso
                $_SESSION['aviso'] = "Dados alterados com sucesso";
                //redirecionar para home
                $this->redirect('/');
            }
            
        }
        //se os dados forem inválidos redireciona para mesma página com aviso
        $_SESSION['aviso'] = "Preencha os dados corretamente";
        $this->redirect('/perfil');
    }

    public function alterarSenha() {
        //renderiza tela para alterar senha
        $view = new ViewController();
        $view->rend('alterarSenha');
    }

    public function alterarSenhaAction() {
        //receber os dados do form
        $senha_antiga = filter_input(INPUT_POST, 'senha_antiga', FILTER_SANITIZE_SPECIAL_CHARS);
        $senha_nova = filter_input(INPUT_POST, 'senha_nova', FILTER_SANITIZE_SPECIAL_CHARS);
        $senha_nova_confirmar = filter_input(INPUT_POST, 'senha_nova_confirmar', FILTER_SANITIZE_SPECIAL_CHARS);
        //verificar se os dados estão preenchidos
        if($senha_antiga && $senha_nova && $senha_nova_confirmar){
            //verifica se o usuário está logado
            $token = $_SESSION['token'];
            if($token){
                //pega o cliente logado
                $cliente = Cliente::select()->where('token', $token)->one();
                //verifica se a senha antiga está correta
                $status = password_verify($senha_antiga, $cliente['senha']);
                if($status){
                    //verifica se a senha nova e a confirmação da senha nova estão iguais
                    if($senha_nova == $senha_nova_confirmar){
                        //criptografar a nova senha
                        $hash = password_hash($senha_nova, PASSWORD_DEFAULT);
                        //atualiza a senha
                        Cliente::update()
                        ->set('senha', $hash)
                        ->where('id', $cliente['id'])
                        ->execute();
                        //mostra mensagem de alterado com sucesso
                        $_SESSION['aviso'] = 'Senha alterada com sucesso!';
                        //redirecionar para home
                        $this->redirect('/');
                    }
                }
            }
        }
        //redireciona para a mesma página com aviso de dados incorretos
        $_SESSION['aviso'] = 'Dados incorretos!';
        $this->redirect('/alterarSenha');
    }

}