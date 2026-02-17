<?php

declare(strict_types=1);

namespace JSONDAVIS\Cover\Actions;

use Doctrine\ORM\EntityManager;
use Faker;
use Slim\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use JSONDAVIS\Cover\Entities\Shift;
use function json_encode;

final readonly class CreateShift implements RequestHandlerInterface
{
  private EntityManager $em;
  private Faker\Generator $faker;

  public function __construct(EntityManager $em, Faker\Generator $faker)
  {
    $this->em = $em;
    $this->faker = $faker;
  }

  public function handle(ServerRequestInterface $request): ResponseInterface
  {
    // $newRandomAccount = new Account($this->faker->email(), $this->faker->password());
    $moveDate = $this->faker->dateTimeThisMonth('Y_m_d');
    $endTime = $this->faker->dateTimeThisMonth('Y_m_d', '+4 hours');
    $newRandomAccount = new Shift(
      $moveDate, 
      $endTime, 
      $this->faker->randomElements(['O', 'F', 'C', 'X']), 
      $this->faker->randomFloat(2, 20, 25) . "" // TODO: fix this so it's a float in the db?
    );

    $this->em->persist($newRandomAccount);
    $this->em->flush();

    // $body = Psr7\Stream::create(json_encode($newRandomAccount, JSON_PRETTY_PRINT) . PHP_EOL);
    // return new Psr7\Response(201, ['Content-Type' => 'application/json'], $body);

    $payload = json_encode($newRandomAccount, JSON_PRETTY_PRINT) . PHP_EOL;

    $response = new Response();
    $response->getBody()->write($payload);

    return $response
      ->withHeader('Content-Type', 'application/json');

  }
}
