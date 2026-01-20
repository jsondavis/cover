<?php

declare(strict_types=1);

namespace Cover\Entities;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\DBAL\Types\Types;


#[Entity]
class Account
{
  #[Id] 
  #[Column(type: Types::INTEGER)] 
  #[GeneratedValue(strategy: 'AUTO')]
  private int $id;

  #[Column(type: 'string')]
  private string $first_name;

  #[Column(type: 'string')]
  private string $last_name;

  #[Column(type: 'string', unique: true, nullable: false)]
  private string $email;

  public function __construct(string $first_name, string $last_name, string $email)
  {
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->email = $email;
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function getName(): string
  {
    return $this->first_name . ' ' . $this->last_name;
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  /**
   * {@inheritdoc}
   */
  public function jsonSerialize(): array
  {
    return [
      'id' => $this->getId(),
      'name' => $this->getName(),
      'email' => $this->email
    ];
  }
}
