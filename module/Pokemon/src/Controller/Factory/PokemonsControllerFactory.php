<?php

namespace Pokemon\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Pokemon\Controller\PokemonController;

class PokemonsControllerFactory implements FactoryInterface {
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        // Instantiate the controller and inject dependencies
        return new PokemonController($entityManager);
    }
}
