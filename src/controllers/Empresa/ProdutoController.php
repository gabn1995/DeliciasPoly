<?php

namespace src\controllers\Empresa;

use \core\Controller;
use src\Config;
use \src\controllers\Empresa\ViewController;
use \src\models\Produto;

class ProdutoController extends Controller
{

    public function listarProdutos()
    {
        $produtos = Produto::select()->execute();

        $view = new ViewController();
        $view->rend('produtos', 'produtos', $produtos);
    }

    public function editarProduto($id)
    {
        $produto = Produto::select()->where('id', $id)->one();

        $view = new ViewController();
        $view->rend('produtoAdd', 'produto', $produto);
    }

    public function editarActionProduto($id)
    {
        //pegar os dados
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_SPECIAL_CHARS);
        $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_SPECIAL_CHARS);
        $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
        $imagem = filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_SPECIAL_CHARS);

        $produto = [
            'id' => $id,
            'nome' => $nome,
            'preco' => $preco,
            'categoria' => $categoria,
            'descricao' => $descricao,
            'imagem' => $imagem
        ];


        if (($_FILES['arquivo']['size'] > 0) && $imagem) {
            //arquivo veio e imagem tambem
            //changed
            if (in_array($_FILES['arquivo']['type'], array('image/jpeg', 'image/jpg', 'image/png'))) {
                move_uploaded_file($_FILES['arquivo']['tmp_name'], "./assets/img/produtos/$imagem.jpg");
            
                $this->redimensionar_imagem($imagem);
            }
            $_SESSION['empresa_aviso'] = "Imagem alterada!";
            // $view = new ViewController();
            // $view->rend('produtoAdd', 'produto', $produto);
            $id_produto = implode(',', $id);
            $this->redirect("/empresa/produto/edit/$id_produto");
        } elseif (($_FILES['arquivo']['size'] > 0) && (!$nome || !$preco || !$categoria || !$descricao || !$imagem)) {
            //arquivo veio e algum campo nao veio
            //changed

            if (in_array($_FILES['arquivo']['type'], array('image/jpeg', 'image/jpg', 'image/png'))) {
                $nome_imagem = md5(time() . rand(0, 1000));
                move_uploaded_file($_FILES['arquivo']['tmp_name'], "./assets/img/produtos/$nome_imagem.jpg");

                $this->redimensionar_imagem($nome_imagem);

                //mudar nome da imagem do produto
                $produto['imagem'] = $nome_imagem;
            }

            $id_produto = implode(',', $id);
            $this->redirect("/empresa/produto/edit/$id_produto");
        } elseif (($_FILES['arquivo']['size'] == 0) && (!$nome || !$preco || !$categoria || !$descricao || !$imagem)) {
            //arquivo não veio e algum campo nao veio
            //submited
            $_SESSION['empresa_aviso'] = "Preencha todos os campos!";
            $id_produto = implode(',', $id);
            $this->redirect("/empresa/produto/edit/$id_produto");
        } elseif (($_FILES['arquivo']['size'] == 0) && $nome && $preco && $categoria && $descricao && $imagem) {
            //arquivo não veio e todos os outros campos vieram
            //submited
            //salvar no database
            //verificar se o usuário está logado
            $token = $_SESSION['empresa_token'];
            if ($token) {
                //salvar os dados no database
                Produto::update()
                    ->set('nome', $nome)
                    ->set('preco', $preco)
                    ->set('categoria', $categoria)
                    ->set('descricao', $descricao)
                    ->set('imagem', $imagem)
                    ->where('id', $id)
                    ->execute();
                //mostra mensagem de alterado com sucesso
                $_SESSION['empresa_aviso'] = "Dados alterados com sucesso";
                //redirecionar para home
                $this->redirect('/empresa/produtos');
            }
        } else {
            $_SESSION['empresa_aviso'] = 'Algo deu errado!';
            $this->redirect('/empresa/produtos');
        }
    }

    public function deletarProduto($id)
    {
        Produto::delete()->where('id', $id)->execute();
        //redireciona a página de listar produtos
        $this->redirect('/empresa/produtos');
    }

    public function adicionarProduto()
    {
        $view = new ViewController();
        $view->rend('produtoAdd');
    }

    public function produtoAction()
    {
        //pegar os dados
        $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
        $preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_SPECIAL_CHARS);
        $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_SPECIAL_CHARS);
        $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
        $imagem = filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_SPECIAL_CHARS);

        $produto = [
            'nome' => $nome,
            'preco' => $preco,
            'categoria' => $categoria,
            'descricao' => $descricao,
            'imagem' => $imagem
        ];


        if (($_FILES['arquivo']['size'] > 0) && ($imagem != 'default')) {
            //arquivo veio e imagem tambem
            //changed
            if (in_array($_FILES['arquivo']['type'], array('image/jpeg', 'image/jpg', 'image/png'))) {
                move_uploaded_file($_FILES['arquivo']['tmp_name'], "./assets/img/produtos/$imagem.jpg");
                
                $this->redimensionar_imagem($imagem);
            }
            $_SESSION['empresa_aviso'] = "Imagem alterada!";
            $view = new ViewController();
            $view->rend('produtoAdd', 'produto', $produto);
        } elseif (($_FILES['arquivo']['size'] > 0) && (!$nome || !$preco || !$categoria || !$descricao || ($imagem == 'default'))) {
            //arquivo veio e algum campo nao veio
            //changed

            if (in_array($_FILES['arquivo']['type'], array('image/jpeg', 'image/jpg', 'image/png'))) {
                $nome_imagem = md5(time() . rand(0, 1000));
                move_uploaded_file($_FILES['arquivo']['tmp_name'], "./assets/img/produtos/$nome_imagem.jpg");

                $this->redimensionar_imagem($nome_imagem);

                //mudar nome da imagem do produto
                $produto['imagem'] = $nome_imagem;
            }

            $view = new ViewController();
            $view->rend('produtoAdd', 'produto', $produto);
        } elseif (($_FILES['arquivo']['size'] == 0) && (!$nome || !$preco || !$categoria || !$descricao || ($imagem == 'default'))) {
            //arquivo não veio e algum campo nao veio
            //submited
            $_SESSION['empresa_aviso'] = "Preencha todos os campos!";
            $view = new ViewController();
            $view->rend('produtoAdd', 'produto', $produto);
        } elseif (($_FILES['arquivo']['size'] == 0) && $nome && $preco && $categoria && $descricao && ($imagem != 'default')) {
            //arquivo não veio e todos os outros campos vieram
            //submited
            //salvar no database
            Produto::insert([
                'nome' => $nome,
                'preco' => $preco,
                'categoria' => $categoria,
                'descricao' => $descricao,
                'imagem' => $imagem
            ])->execute();

            $_SESSION['empresa_aviso'] = 'Produto salvo!';
            $this->redirect('/empresa/produtos');
        } else {
            $_SESSION['empresa_aviso'] = 'Algo deu errado!';
            $this->redirect('/empresa/produtos');
        }
    }

    public function redimensionar_imagem($imagem){
        $arquivo = $_SERVER[ 'DOCUMENT_ROOT' ].Config::BASE_DIR."/assets/img/produtos/$imagem.jpg";
        // $destino = $_SERVER[ 'DOCUMENT_ROOT' ].Config::BASE_DIR.'/assets/recibos/'.$dados['arquivo'].'.pdf';

        $largura = 350;
        $altura = 200;

        if(file_exists($arquivo)){

            list($largura_original, $altura_original) = getimagesize($arquivo);

            $ratio = $largura_original/$altura_original;

            if($largura/$altura > $ratio){
                $largura = $altura * $ratio;
            }else{
                $altura = $largura / $ratio;
            }

            $imagem_final = imagecreatetruecolor($largura, $altura);
            $imagem_original = imagecreatefromjpeg($arquivo);

            imagecopyresampled(
                $imagem_final, $imagem_original,
                0,0,0,0,
                $largura, $altura, $largura_original, $altura_original
            );

            imagejpeg($imagem_final, "./assets/img/produtos/$imagem.jpg", 100);


        }


    }
}
