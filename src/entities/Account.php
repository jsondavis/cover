<?php

declare(strict_types=1);

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\GeneratedValue;


#[Entitiy, Table(name: 'account')]
final readonly class Account
{
  #[Id, Column(type: 'integer'), GeneratedValue(strategy: 'AUTO')]
  private int $id;

  #[Column(type: 'string', unique: true, nullable: false)]
  private string $rolename;

  public function __construct(string $rolename)
  {
    $this->rolename = $rolename;
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function getRolename(): string
  {
    return $this->rolename;
  }

  /**
   * {@inheritdoc}
   */
  public function jsonSerialize(): array
  {
    return [
      'id' => $this->getId(),
      'getRolename' => $this->getRolename()
    ];
  }
}
