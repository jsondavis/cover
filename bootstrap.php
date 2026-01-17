<?php
// bootstrap

require __DIR__ . '/../vendor/autoload.php';

## Get ENV data
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();
$dotenv->required([
  'DB_HOST', 
  'DB_NAME', 
  'DB_USER', 
  'DB_PASS', 
  'SSL_MODE'
]);


$isDev = $_ENV['APP_ENV'] == 'dev'; 

## Configure DB Connection
require_once __DIR__ . '/dbconfig.php';


