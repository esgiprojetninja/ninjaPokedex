<?php

namespace Pokemon\Controller;

use Interop\Container\ContainerInterface;

class AdminControllerFactory {
    function __invoke(ContainerInterface $container) {
        return new AdminController(
            $container->get('Pokemon\Service\PokemonService'),
            $container->get('Pokemon\Service\AdminService'),
            $container->get('Pokemon\InputFilter\UpdatePokemonPost'),
            $container->get('Pokemon\Service\ImageManager'),
            $container->get('Pokemon\Service\TypeService')
        );
    }
}
