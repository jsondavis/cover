<?php

declare(strict_types=1);

// src/JobRole.php


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\GeneratedValue;
// use JsonSerializable;


#[Entitiy, Table(name: 'jobroles')]
final readonly class JobRole
// final readonly class JobRole implements JsonSerializable
{
  #[Id, Column(type: 'integer'), GeneratedValue(strategy: 'AUTO')]
  private int $id;

  #[Column(type: 'string', unique: true, nullable: false)]
  private string $rolename;
}
