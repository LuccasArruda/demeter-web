<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::Index');
$routes->get('/home', 'Home::Index');

$routes->get('/login', 'Login::Index');

$routes->get('/teste-conexao', 'Teste::testarConexao');

$routes->get('/cadastrar-usuario', 'CadastrarUsuario::index');
$routes->post('/cadastrar-usuario', 'CadastrarUsuario::cadastrar');

$routes->get('/cadastrar-ambiente', 'CadastrarAmbiente::index');
