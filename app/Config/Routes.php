<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/login', 'UsuarioController::paginaLogin');
$routes->get('/login/recuperar-senha', 'UsuarioController::paginaRecuperarSenha');
$routes->get('/cadastrar-usuario', 'UsuarioController::paginaCadastro');
$routes->post('/cadastrar-usuario', 'UsuarioController::cadastrar');

$routes->get('/cadastrar-ambiente', 'AmbienteController::paginaCadastro');
$routes->get('/ambientes', 'AmbienteController::visualizar');

$routes->get('/cadastrar-rede-eletrica', 'RedeEletricaController::paginaCadastro');
$routes->get('/redes-eletricas', 'RedeEletricaController::visualizar');
$routes->post('/cadastrar-rede-eletrica', 'RedeEletricaController::cadastrar');


$routes->get('/cadastrar-aparelho', 'AparelhoController::paginaCadastroAparelho');
$routes->post('/cadastrar-aparelho', 'AparelhoController::cadastrarAparelho');

$routes->get('/cadastrar-gerador', 'GeradorController::paginaCadastroGerador');
$routes->post('/cadastrar-gerador', 'GeradorController::cadastrarGerador');

$routes->get('/aparelhos', 'AparelhoController::visualizar');


$routes->get('/teste-conexao', 'Teste::testarConexao');


