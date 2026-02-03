<?php
// bootstrap

declare(strict_types=1);

use UMA\DIC\Container;

require __DIR__ . '/vendor/autoload.php';

if (!file_exists(__DIR__ . '/.env')) {
  // no env found copying default
  copy(__DIR__ . '/env.dist', __DIR__ . '/.env');
}

## Get ENV data
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
$dotenv->required([
  'DB_HOST', 
  'DB_NAME', 
  'DB_USER', 
  'DB_PASS', 
  'SSL_MODE'
]);


// settings object to pass to DI container
$APP_SETTINGS = [

];

$isDev = $_ENV['APP_ENV'] == 'dev'; 

## Configure DB Connection
require_once __DIR__ . '/src/dbconfig.php';


