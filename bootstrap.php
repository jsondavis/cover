<?php
// bootstrap

declare(strict_types=1);

use UMA\DIC\Container;

require __DIR__ . '/vendor/autoload.php';

if (!file_exists(__DIR__ . '/.env')) {
  // no env found copying default
  copy(__DIR__ . '/env.dist', __DIR__ . '/.env');
}

const APP_ROOT = __DIR__;

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

$isDev = $_ENV['APP_ENV'] == 'dev'; 

// settings object to pass to DI container
$APP_SETTINGS = [
  'settings' => [
    'slim' => [
      // Returns a detailed HTML page with error details and
      // a stack trace. Should be disabled in production.
      'displayErrorDetails' => true,

      // Whether to display errors on the internal PHP log or not.
      'logErrors' => true,

      // If true, display full errors with message and stack trace on the PHP log.
      // If false, display only "Slim Application Error" on the PHP log.
      // Doesn't do anything when 'logErrors' is false.
      'logErrorDetails' => true,
    ],
    'doctrine' => [
      # 'DB_HOST' => $_ENV['DB_HOST'], 
      # 'DB_NAME' => $_ENV['DB_NAME'], 
      # 'DB_USER' => $_ENV['DB_USER'], 
      # 'DB_PASS' => $_ENV['DB_PASS'], 
      # 'SSL_MODE' => $_ENV['SSL_MODE'],

      // Enables or disables Doctrine metadata caching
      // for either performance or convenience during development.
      'dev_mode' => $isDev,

      // Path where Doctrine will cache the processed metadata
      // when 'dev_mode' is false.
      'cache_dir' => APP_ROOT . '/var/doctrine',

      // List of paths where Doctrine will search for
      // metadata. Metadata can be either YML/XML files or
      // annotated PHP classes.
      'metadata_dirs' => [APP_ROOT . '/src/Entities'],


      'connection' => [
        'driver' => 'pdo_pgsql',
        // 'host' => $_ENV['DB_HOST'],
        'host' => 'posty',
        'dbname' => $_ENV['DB_NAME'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASS'],
        //   'sslmode' => $_ENV['SSL_MODE'],
      ]
    ]
  ]
];


## Configure DB Connection
// require_once __DIR__ . '/src/dbconfig.php';

return new Container($APP_SETTINGS);

