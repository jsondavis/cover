<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;


$config = ORMSetup::createAttributeMetadataConfig(
  paths: [__DIR__ . '/../src'],
  isDevMode: $isDev,
);

$connection_info = [
  'driver' => 'pdo_pgsql',
  'host' => $_ENV['DB_HOST'],
  'dbname' => $_ENV['DB_NAME'],
  'user' => $_ENV['DB_USER'],
  'password' => $_ENV['DB_PASS'],
  'sslmode' => $_ENV['SSL_MODE'],
];

$conn = DriverManager::getConnection($connection_info);


$resultSet = $conn->executeQuery('SELECT * FROM roles');
$allowed_roles = $resultSet->fetchAssociative();

var_dump($allowed_roles);

