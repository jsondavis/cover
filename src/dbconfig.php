<?php

use Doctrine\ORM\Configuration;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

// TODO: alter these later for prod deploy
$isDev = true;
// $entityDir = __DIR__ . '/entities';
$entityDir = '/var/www/src/entities';

// var_dump($entityDir);


$driverImpl = new AttributeDriver([$entityDir]);
$queryCache = new ArrayAdapter();
$metadataCache = new ArrayAdapter();


$config = new Configuration;
// $config->setAnnotationDriver
$config->setMetadataDriverImpl($driverImpl);
$config->setMetadataCache($metadataCache);
$config->setQueryCache($queryCache);

$proxyDir = 'data/DoctrineORMModule/Proxy';

$config->setProxyDir(__DIR__ . '/../'  . $proxyDir);
$config->setProxyNamespace('Proxies');


$postgres_info = [
  'driver' => 'pdo_pgsql',
  // 'host' => $_ENV['DB_HOST'],
  'host' => 'posty',
  'dbname' => $_ENV['DB_NAME'],
  'user' => $_ENV['DB_USER'],
  'password' => $_ENV['DB_PASS'],
//   'sslmode' => $_ENV['SSL_MODE'],
];

$conn = DriverManager::getConnection($postgres_info);

$entityMgr = new EntityManager($conn, $config);


// $resultSet = $conn->executeQuery('SELECT * FROM valid_jobroles');
// $allowed_roles = $resultSet->fetchAssociative();

// var_dump($allowed_roles);

