<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/home', 'Home::getIndex');
$routes->get('/login', 'Login::getIndex');
$routes->get('/teste-conexao', 'Teste::testarConexao');
