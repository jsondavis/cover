<?php

declare(strict_types=1);

namespace JSONDAVIS\Cover\Actions;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Slim\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use JSONDAVIS\Cover\Entities\Account;
use function json_encode;

final readonly class ListAccounts implements RequestHandlerInterface
{
    private EntityManager $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function handle(Request $request): ResponseInterface
    {
        /** @var Account[] $accounts */
        $accounts = $this->em
            ->getRepository(Account::class)
            ->findAll(Query::HYDRATE_ARRAY);

        $serial = array_map(function($a) {
          return $a->jsonSerialize();
        }, $accounts);

        $payload = json_encode($serial, JSON_PRETTY_PRINT) . PHP_EOL;

        $response = new Response();
        $response->getBody()->write($payload);

        return $response
           ->withHeader('Content-Type', 'application/json');
    }
}
