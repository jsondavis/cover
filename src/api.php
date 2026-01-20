<?php

require __DIR__ . '/../bootstrap.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\PhpRenderer;

$app = AppFactory::create();

$app->get('/hello', function (Request $request, Response $response, $args) {
    $response->getBody()->write('Hello world!');
    return $response;
});

$app->get('/account', function (Request $request, Response $response, $args) {
    $response->getBody()->write('account');
    return $response;
});

$app->get('/accountrole', function (Request $request, Response $response, $args) {
    $response->getBody()->write('accountrole');
    return $response;
});

$app->get('/', function (Request $request, Response $response, $args) {
  $renderer = new PhpRenderer(__DIR__ . '/Templates');
  return $renderer->render($response, 'home.php', []);
});

