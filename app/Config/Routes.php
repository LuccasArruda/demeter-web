<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/login', 'UsuarioController::paginaLogin');
$routes->get('/login/recuperar-senha', 'UsuarioController::paginaRecuperarSenha');
$routes->post('/autenticar-usuario', 'UsuarioController::autenticar');
$routes->get('/cadastrar-usuario', 'UsuarioController::paginaCadastro');
$routes->get('/logout-usuario', 'UsuarioController::logout');
$routes->post('/cadastrar-usuario', 'UsuarioController::cadastrar');

$routes->get('/cadastrar-ambiente', 'AmbienteController::paginaCadastro');
$routes->get('/ambientes', 'AmbienteController::meusAmbientes');
$routes->get('/ambiente/excluir/(:num)', 'AmbienteController::excluir/$1');
$routes->post('/ambiente/salvar', 'AmbienteController::cadastrar');

$routes->get('/cadastrar-rede-eletrica', 'RedeEletricaController::paginaCadastro');
$routes->get('/redes-eletricas/(:num)', 'RedeEletricaController::visualizar/$1');
$routes->post('/rede-eletrica/salvar', 'RedeEletricaController::cadastrar');

$routes->get('/cadastrar-aparelho', 'AparelhoController::paginaCadastroAparelho');
$routes->post('/aparelho/salvar', 'AparelhoController::cadastrar');

$routes->get('/cadastrar-gerador', 'GeradorController::paginaCadastroGerador');
$routes->post('/cadastrar-gerador', 'GeradorController::cadastrarGerador');

$routes->get('/aparelhos', 'AparelhoController::visualizar');

$routes->get('/teste-conexao', 'Teste::testarConexao');


