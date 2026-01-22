<?php

declare(strict_types=1);

namespace Cover\Entities;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\DBAL\Types\Types;

use Cover\Entities\Account;

enum Status: string {
  case Open = 'O';
  case Filled = 'F';
  case Completed = 'C';
  case Cancelled = 'X';
}

#[Entity]
class Shift
{
  #[Id] 
  #[Column(type: Types::INTEGER)] 
  #[GeneratedValue(strategy: 'AUTO')]
  private int $shift_id;

  private Account $leader;

  private Account $helper;

  #[Column(type: 'datetime', nullable: false)]
  private string $start_time;

  #[Column(type: 'datetime', nullable: false)]
  private string $end_time;

  #[Column(type: 'string')]
  private string $status;

  #[Column(type: 'decimal', precision: 15, scale: 4)]
  private string $pay_rate;


  public function __construct(string $start_time, string $end_time, string $status, string $pay_rate)
  {
    $this->start_time = $start_time;
    $this->end_time = $end_time;
    $this->status = $status;
    $this->pay_rate = $pay_rate;
  }

  public function getId(): int
  {
    return $this->shift_id;
  }
  
  
  /**
   * {@inheritdoc}
   */
  public function jsonSerialize(): array
  {
    return [
      'shift_id' => $this->getId()
    ];
  }
}
