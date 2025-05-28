<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');

$routes->get('/login', 'UsuarioController::paginaLogin');
$routes->get('/login/recuperar-senha', 'UsuarioController::paginaRecuperarSenha');
$routes->get('/cadastrar-usuario', 'UsuarioController::paginaCadastro');
$routes->post('/cadastrar-usuario', 'UsuarioController::cadastrar');

$routes->get('/cadastrar-ambiente', 'AmbienteController::paginaCadastro');
$routes->get('/ambientes', 'AmbientesController::visualizar');
$routes->post('/cadastrar-usuario', 'UsuarioController::cadastrar');

$routes->get('/cadastrar-rede-eletrica', 'RedeEletricaController::cadastrarRedeEletrica');
$routes->get('/redes-eletricas', 'RedesEletricasController::visualizar');
$routes->post('/cadastrar-usuario', 'UsuarioController::cadastrar');

$routes->get('/cadastrar-aparelho', 'AparelhoController::paginaCadastroAparelho');
$routes->post('/cadastrar-usuario', 'UsuarioController::cadastrarAparelho');
$routes->get('/cadastrar-gerador', 'AparelhoController::paginaCadastroGerador');
$routes->post('/cadastrar-usuario', 'UsuarioController::cadastrarGerador');
$routes->get('/aparelhos', 'VisualizarAparelhos::visualizar');

$routes->get('/teste-conexao', 'Teste::testarConexao');


