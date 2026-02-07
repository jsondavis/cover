<?php

declare(strict_types=1);

namespace JSONDAVIS\Cover\Actions;

use Slim\Psr7\Response;
use Slim\Views\PhpRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;

final readonly class ServeHome implements RequestHandlerInterface
{
  private PhpRenderer $renderer;

  public function __construct()
  {
    $this->renderer = new PhpRenderer(__DIR__ . '/../Templates');
  }

  
  public function handle(Request $request): ResponseInterface
  {
    $response = new Response();
    return $this->renderer->render($response, 'home.php', []);
  }

}
