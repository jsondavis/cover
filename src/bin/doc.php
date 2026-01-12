#!/usr/bin/env php

<?php
// bin/doc
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

// Adjust this path to your actual bootstrap.php
require __DIR__ . '/../bootstrap.php';
require __DIR__ . '/../dbconfig.php';


ConsoleRunner::run(
    new SingleManagerProvider($entityMgr)
);

