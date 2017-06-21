<?php

namespace Pokemon\Controller;

use Interop\Container\ContainerInterface;

class AdminControllerFactory {
    function __invoke(ContainerInterface $container) {
        return new AdminController($container->get('Pokemon\Service\PokemonService'));
    }
}
