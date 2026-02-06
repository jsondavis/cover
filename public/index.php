<?php

declare(strict_types=1);

use Slim\App;
use UMA\DIC\Container;
use JSONDAVIS\Cover\DI;

// require __DIR__ . '/../bootstrap.php';
// require __DIR__ . '/../src/api.php';

$container = require_once __DIR__ . '/../bootstrap.php';

$container->register(new DI\Doctrine());
$container->register(new DI\Slim());

$app = $container->get(App::class);
$app->run();
