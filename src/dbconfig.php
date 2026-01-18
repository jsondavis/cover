<?php

use Doctrine\ORM\Configuration;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;


$isDev = true;
$entityDir = '/var/www/src/entities';
$proxyDir = 'data/DoctrineORMModule/Proxy';

$postgres_info = [
  'driver' => 'pdo_pgsql',
  // 'host' => $_ENV['DB_HOST'],
  'host' => 'posty',
  'dbname' => $_ENV['DB_NAME'],
  'user' => $_ENV['DB_USER'],
  'password' => $_ENV['DB_PASS'],
//   'sslmode' => $_ENV['SSL_MODE'],
];

$queryCache = $isDev ? 
  new ArrayAdapter() : 
  new FileSystemAdapter(directory: $proxyDir);


$config = ORMSetup::createAttributeMetadataConfiguration(
  [$entityDir], // metadata_dirs
  $isDev, // dev_mode
  null, //not sure what this is
  $queryCache
);

$conn = DriverManager::getConnection($postgres_info);
$entityMgr = new EntityManager($conn, $config);

// $resultSet = $conn->executeQuery('SELECT * FROM valid_jobroles');
// $allowed_roles = $resultSet->fetchAssociative();
