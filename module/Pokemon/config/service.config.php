<?php
namespace Pokemon;
return [
    'invokables' => [
        'Pokemon\Repository\PokemonRepository' => 'Pokemon\Repository\PokemonRepositoryImpl',
        'Pokemon\Repository\AdminRepository' => 'Pokemon\Repository\AdminRepositoryImpl'
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
