<?php

namespace Pokemon\Controller;

use Interop\Container\ContainerInterface;

class PokemonsControllerFactory {
    function __invoke(ContainerInterface $container) {
        return new PokemonsController($container->get('Pokemon\Service\PokemonService'));
    }
}
