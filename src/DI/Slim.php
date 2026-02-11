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
// use JSONDAVIS\Cover\Actions\CreateShift;
use JSONDAVIS\Cover\Actions\ListShifts;
// use JSONDAVIS\Cover\Actions\CreateRole;
use JSONDAVIS\Cover\Actions\ListRoles;

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

    // Account
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

    // Shift
    $c->set(ListShifts::class, static function(ContainerInterface $c): RequestHandlerInterface {
      return new ListShifts(
        $c->get(EntityManager::class)
      );
    });

    // $c->set(CreateShift::class, static function(ContainerInterface $c): RequestHandlerInterface {
    //   return new CreateShift(
    //     $c->get(EntityManager::class),
    //     Faker\Factory::create()
    //   );
    // });

    // Role
    $c->set(ListRoles::class, static function(ContainerInterface $c): RequestHandlerInterface {
      return new ListRoles(
        $c->get(EntityManager::class)
      );
    });

    // $c->set(CreateShift::class, static function(ContainerInterface $c): RequestHandlerInterface {
    //   return new CreateShift(
    //     $c->get(EntityManager::class),
    //     Faker\Factory::create()
    //   );
    // });

    // HTML Template
    $c->set(ServeHome::class, static function(ContainerInterface $c): RequestHandlerInterface {
      return new ServeHome();
    });

    // Slim App Config
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

      // Account Routes
      $app->get('/account', ListAccounts::class);
      $app->post('/account', CreateAccount::class);

      // Account Role Routes
      $app->get('/role', ListRoles::class);
      // roles probably should be static 
      // to begin with? 
      // it's not like they change that often
      // $app->post('/role', CreateAccount::class);

      // Shift Routes
      $app->get('/shift', ListShifts::class);
      $app->post('/shift', CreateAccount::class);


      $app->get('/', ServeHome::class);

      return $app;
    });
  }
}
