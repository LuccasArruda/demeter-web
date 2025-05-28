<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');

$routes->get('/login', 'Login::index');
$routes->get('/login/recuperar-senha', 'Login::recuperarSenha');

$routes->get('/teste-conexao', 'Teste::testarConexao');

$routes->get('/cadastrar-usuario', 'CadastrarUsuario::index');
$routes->post('/cadastrar-usuario', 'CadastrarUsuario::cadastrar');

$routes->get('/cadastrar-ambiente', 'CadastrarAmbiente::index');
