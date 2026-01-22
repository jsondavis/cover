<?php

declare(strict_types=1);

namespace Cover\Entities;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\ArrayCollection;

use Cover\Entities\Shift;

#[Entity]
class Account
{
  #[Id] 
  #[Column(type: Types::INTEGER)] 
  #[GeneratedValue(strategy: 'AUTO')]
  private int $account_id;

  #[Column(type: 'string')]
  private string $first_name;

  #[Column(type: 'string')]
  private string $last_name;

  #[Column(type: 'string', unique: true, nullable: false)]
  private string $email;

  #[Column(type: 'decimal', precision: 15, scale: 4)]
  private string $pay_rate;

  /** @var Collection<int, Shift> */
  private Collection $claimed_shifts;

  /** @var Collection<int, Shift> */
  private Collection $completed_shifts;

  public function __construct(string $first_name, string $last_name, string $email, string $pay_rate)
  {
    $this->first_name = $first_name;
    $this->last_name = $last_name;
    $this->email = $email;
    $this->pay_rate = $pay_rate;
    $this->claimed_shifts = new ArrayCollection();
    $this->completed_shifts = new ArrayCollection();
  }

  public function getId(): int
  {
    return $this->account_id;
  }

  public function getName(): string
  {
    return $this->first_name . ' ' . $this->last_name;
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function getRate(): string
  {
    return $this->pay_rate;
  }

  /**
   * {@inheritdoc}
   */
  public function jsonSerialize(): array
  {
    return [
      'account_id' => $this->account_id(),
      'name' => $this->getName(),
      'email' => $this->email,
      'pay_rate' => $this->pay_rate
    ];
  }
}
