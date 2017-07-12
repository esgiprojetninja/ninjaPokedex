<?php

namespace Pokemon\Controller;

use Interop\Container\ContainerInterface;

class TypesControllerFactory {
    function __invoke(ContainerInterface $container) {
        return new TypesController($container->get('Pokemon\Service\TypeService'));
    }
}
