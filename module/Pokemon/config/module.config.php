<?php
namespace Pokemon;
return [
    'controllers' => [
        'factories' => [
            'Pokemon\Controller\Pokemon' => 'Pokemon\Controller\PokemonControllerFactory',
        ],
    ],
    'router' => [
        'routes' => [
            'pokemon' => [
                'type'    => 'segment',
                'options' => [
                    'route'    => '/pokemon[/:id]',
                    'constraints' => [
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => 'Pokemon\Controller\Pokemon',
                        'action' => 'get'
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
