<?php
namespace Pokedex;
return [
    'invokables' => [
        'Pokedex\Repository\PostRepository' => 'Pokedex\Repository\PostRepositoryImpl'
    ],
    'factories' => [
        'Pokedex\Service\PokedexService' => function(\Zend\ServiceManager\ServiceManager $sl) {
            $pokedexService = new \Pokedex\Service\PokedexServiceImpl();
            $pokedexService->setPostRepository($sl->get('Pokedex\Repository\PostRepository'));
            return $pokedexService;
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
