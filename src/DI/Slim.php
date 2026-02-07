<?php

declare(strict_types=1);

namespace JSONDAVIS\Cover\DI;

use Doctrine\ORM\EntityManager;
use Faker;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Middleware\ContentLengthMiddleware;
use UMA\DIC\Container;
use UMA\DIC\ServiceProvider;
use JSONDAVIS\Cover\Actions\CreateAccount;
use JSONDAVIS\Cover\Actions\ListAccounts;
use JSONDAVIS\Cover\Actions\ServeHome;

/**
 * A ServiceProvider for registering services related
 * to Slim such as request handlers, routing and the
 * App service itself that wires everything together.
 */
final readonly class Slim implements ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function provide(Container $c): void
    {

        $c->set(ListAccounts::class, static function(ContainerInterface $c): RequestHandlerInterface {
            return new ListAccounts(
                $c->get(EntityManager::class)
            );
        });

        $c->set(CreateAccount::class, static function(ContainerInterface $c): RequestHandlerInterface {
            return new CreateAccount(
                $c->get(EntityManager::class),
                Faker\Factory::create()
            );
        });

        $c->set(ServeHome::class, static function(ContainerInterface $c): RequestHandlerInterface {
          return new ServeHome();
        });

        $c->set(App::class, static function (ContainerInterface $c): App {
            /** @var array $settings */
            $settings = $c->get('settings');

            $app = AppFactory::create(null, $c);

            $app->addErrorMiddleware(
                $settings['slim']['displayErrorDetails'],
                $settings['slim']['logErrors'],
                $settings['slim']['logErrorDetails']
            );

            $app->add(new ContentLengthMiddleware());

            $app->get('/accounts', ListAccounts::class);
            $app->post('/accounts', CreateAccount::class);
            $app->get('/', ServeHome::class);

            return $app;
        });
    }
}
