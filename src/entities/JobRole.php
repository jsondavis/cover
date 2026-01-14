<?php
// src/JobRole.php

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entitiy]
#[ORM\Table(name: 'jobroles')]
class JobRole
{
  #[ORM\Id]
  #[ORM\Column(type: 'integer')]
  #[ORM\GeneratedValue]
  private int|null $id = null;
  #[ORM\Column(type: 'string')]
  private string $rolename;
}
