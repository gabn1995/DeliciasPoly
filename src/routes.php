<?php
use core\Router;

$router = new Router();

//rotas da empresa
$router->get('/empresa', 'Empresa\HomeController@index');
$router->get('/empresa/home', 'Empresa\HomeController@home');
$router->get('/empresa/sair', 'Empresa\HomeController@sair');
$router->post('/empresa/loginAction', 'Empresa\LoginController@loginAction');

$router->get('/empresa/pedidos', 'Empresa\PedidoController@listarPedidosTodos');
$router->get('/empresa/pedidos/{status}', 'Empresa\PedidoController@listarPedidos');
$router->get('/empresa/pedido/cliente/{id}', 'Empresa\PedidoController@pedido_cliente');
$router->get('/empresa/pedido/produto/{id}', 'Empresa\PedidoController@pedido_produto');
$router->get('/empresa/pedido/endereco/{id}', 'Empresa\PedidoController@pedido_endereco');
$router->get('/empresa/pedido/finalizar/{id}', 'Empresa\PedidoController@finalizarPedido');
$router->get('/empresa/pedido/delete/{id}', 'Empresa\PedidoController@deletarPedido');
$router->get('/empresa/pedido/pagar/{id}', 'Empresa\PedidoController@pagarPedido');

$router->post('/empresa/recibo/{id}', 'Empresa\ReciboController@pegarRecibo');

$router->get('/empresa/clientes', 'Empresa\ClienteController@listarClientes');
$router->get('/empresa/cliente/edit/{id}', 'Empresa\ClienteController@editarCliente');
$router->post('/empresa/cliente/editAction/{id}', 'Empresa\ClienteController@editarActionCliente');
$router->get('/empresa/cliente/delete/{id}', 'Empresa\ClienteController@deletarCliente');

$router->get('/empresa/produtos', 'Empresa\ProdutoController@listarProdutos');
$router->get('/empresa/produto/edit/{id}', 'Empresa\ProdutoController@editarProduto');
$router->post('/empresa/produto/editAction/{id}', 'Empresa\ProdutoController@editarActionProduto');
$router->get('/empresa/produto/delete/{id}', 'Empresa\ProdutoController@deletarProduto');
$router->get('/empresa/produto/add', 'Empresa\ProdutoController@adicionarProduto');
$router->post('/empresa/produto/action/', 'Empresa\ProdutoController@produtoAction');
$router->post('/empresa/produto/action/{id}', 'Empresa\ProdutoController@editarActionProduto');

//rotas do cliente
$router->get('/login', 'Cliente\LoginController@login');
$router->post('/login', 'Cliente\LoginController@loginAction');
$router->get('/sair', 'Cliente\LoginController@sair');

$router->get('/cadastro', 'Cliente\CadastroController@cadastro');
$router->post('/cadastro', 'Cliente\CadastroController@cadastroAction');

$router->get('/perfil', 'Cliente\PerfilController@perfil');
$router->post('/perfilAction', 'Cliente\PerfilController@perfilAction');
$router->get('/alterarSenha', 'Cliente\PerfilController@alterarSenha');
$router->post('/alterarSenhaAction', 'Cliente\PerfilController@alterarSenhaAction');

$router->post('/salvarCarrinho', 'Cliente\CarrinhoController@salvarCarrinho');
$router->get('/lerCarrinho', 'Cliente\CarrinhoController@lerCarrinho');
$router->post('/limparCarrinho', 'Cliente\CarrinhoController@limparCarrinho');

$router->get('/pagamento', 'Cliente\PagamentoController@index');
$router->post('/pagamentoAction', 'Cliente\PagamentoController@pagamentoAction');

$router->get('/', 'Cliente\HomeController@index');
$router->get('/filtro/', 'Cliente\HomeController@index');
$router->get('/filtro/{filtro}', 'Cliente\HomeController@filtro');



