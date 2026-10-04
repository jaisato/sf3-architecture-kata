<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Acme\BlogBundle\Command\TopicCommand;
use Acme\BlogBundle\Controller\TopicController;
use Acme\BlogBundle\TopicManager;

/*
 * Exercise 5: the bundle's services, loaded by CustomExtension. PHP rather
 * than XML, which Symfony 7.4 deprecates for configuration.
 */
return static function (ContainerConfigurator $container): void {
    $services = $container->services()
        ->defaults()
            ->autowire()
            // Tags the controller (#[Route]: routes and arguments) and the
            // command (#[AsCommand]).
            ->autoconfigure();

    // Private, like every service. The controller and the command use it, so
    // it survives the compilation and the test container can reach it.
    $services->set('acme.blog.topic_manager', TopicManager::class);
    $services->alias(TopicManager::class, 'acme.blog.topic_manager');

    $services->set(TopicController::class);
    $services->set(TopicCommand::class);
};
