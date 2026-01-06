<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require __DIR__ . '/../vendor/autoload.php';


$config = ORMSetup::createAttributeMetadataConfig(
  paths: [__DIR__ . '/src'],
  isDevMode: true,
);

$connection_info = [
  'driver' => 'pdo_pgsql',
  'host' => 'localhost',
  'dbname' => 'coverdb',
  'user' => '',
  'password' => '',
];

$connection = DriverManager::getConnection($connection_info);


$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->run();
