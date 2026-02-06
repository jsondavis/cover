<?php

declare(strict_types=1);

namespace JSONDAVIS\Cover\Actions;

use Doctrine\ORM\EntityManager;
// use Nyholm\Psr7;
use Slim\Psr7;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
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

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /** @var Account[] $accounts */
        $accounts = $this->em
            ->getRepository(Account::class)
            ->findAll();

        $body = Psr7\Stream::create(json_encode($account, JSON_PRETTY_PRINT) . PHP_EOL);

        return new Psr7\Response(200, ['Content-Type' => 'application/json'], $body);
    }
}
