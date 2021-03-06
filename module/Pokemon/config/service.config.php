<?php
namespace Pokemon;
return [
    'invokables' => [
        'Pokemon\Repository\PokemonRepository' => 'Pokemon\Repository\PokemonRepositoryImpl',
        'Pokemon\Repository\AdminRepository' => 'Pokemon\Repository\AdminRepositoryImpl',
        'Pokemon\Repository\TypeRepository' => 'Pokemon\Repository\TypeRepositoryImpl'
    ],
    'factories' => [
        'Pokemon\Service\PokemonService' => function(\Zend\ServiceManager\ServiceManager $sl) {
            $pokemonService = new \Pokemon\Service\PokemonServiceImpl();
            $pokemonService->setPokemonRepository($sl->get('Pokemon\Repository\PokemonRepository'));
            return $pokemonService;
        },
        'Pokemon\Service\AdminService' => function(\Zend\ServiceManager\ServiceManager $sl) {
            $adminService = new \Pokemon\Service\AdminServiceImpl();
            $adminService->setAdminRepository($sl->get('Pokemon\Repository\AdminRepository'));
            return $adminService;
        },
        'Pokemon\Service\TypeService' => function(\Zend\ServiceManager\ServiceManager $sl) {
            $typeService = new \Pokemon\Service\TypeServiceImpl();
            $typeService->setTypeRepository($sl->get('Pokemon\Repository\TypeRepository'));
            return $typeService;
        },
        'Pokemon\InputFilter\UpdatePokemonPost' => function(\Zend\ServiceManager\ServiceManager $sm) {
            return new \Pokemon\InputFilter\UpdatePokemonPost(
                $sm->get('Zend\Db\Adapter\Adapter'),
                $sm->get('Pokemon\Service\ImageManager')
            );
        },
        'Pokemon\InputFilter\CreatePokemonPost' => function(\Zend\ServiceManager\ServiceManager $sm) {
            return new \Pokemon\InputFilter\CreatePokemonPost(
                $sm->get('Zend\Db\Adapter\Adapter'),
                $sm->get('Pokemon\Service\ImageManager')
            );
        }
    ],
    'initializers' => [
        function (\Zend\ServiceManager\ServiceManager $sl, $instance) {
            if ($instance instanceof \Zend\Db\Adapter\AdapterAwareInterface) {
                $instance->setDbAdapter($sl->get('Zend\Db\Adapter\Adapter'));
            }
        }
    ]
];
