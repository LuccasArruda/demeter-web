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
$routes->get('/rede-eletrica/editar/(:num)', 'RedeEletricaController::editar/$1');
$routes->post('/rede-eletrica/editar/salvar/(:num)', 'RedeEletricaController::atualizar/$1');
$routes->get('/rede-eletrica/excluir/(:num)', 'RedeEletricaController::excluir/$1');

$routes->get('/cadastrar-aparelho', 'AparelhoController::paginaCadastroAparelho');
$routes->get('/aparelho/editar/(:num)', 'AparelhoController::editar/$1');
$routes->post('/aparelho/salvar', 'AparelhoController::cadastrar');
$routes->post('/aparelho/editar/salvar/(:num)', 'AparelhoController::atualizar/$1');
$routes->get('/aparelhos/(:num)', 'AparelhoController::visualizar/$1');
$routes->get('/aparelho/excluir/(:num)', 'AparelhoController::excluir/$1');

$routes->get('/cadastrar-gerador', 'GeradorController::paginaCadastroGerador');
$routes->post('/gerador/salvar', 'GeradorController::cadastrarGerador');
$routes->get('/gerador/editar/(:num)', 'GeradorController::editar/$1');
$routes->post('/gerador/editar/salvar/(:num)', 'GeradorController::atualizar/$1');

$routes->get('/teste-conexao', 'Teste::testarConexao');


