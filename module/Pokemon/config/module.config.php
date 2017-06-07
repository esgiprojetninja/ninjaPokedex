<?php
namespace Pokemon;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\Router\Http\Segment;

return [
    'controllers' => [
        'factories' => [
            Controller\PokemonController::class => Controller\Factory\PokemonControllerFactory::class,
        ],
    ],
    // 'service_manager' => [
    //     'factories' => [
    //         Service\PokemonManager::class => Service\Factory\PokemonManagerFactory::class,
    //     ],
    // ],
    'router' => [
        'routes' => [
            'pokemons' => [
                'type'    => Segment::class,
                'options' => [
                   'route'    => '/pokemons[/:id]',
                    'constraints' => [
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' =>   Controller\PokemonController::class,
                    ],
                ],
                'child_routes' => [
                    'update' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/update[/:id]',
                             'constraints' => [
                                 'id'     => '[0-9]+',
                             ],
                            'defaults' => [
                                'controller' =>   Controller\PokemonController::class
                            ],
                        ],
                    ],
                    'create' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/create[/:id]',
                             'constraints' => [
                                 'id'     => '[0-9]+',
                             ],
                            'defaults' => [
                                'controller' =>   Controller\PokemonController::class
                            ],
                        ],
                    ],
                    'delete' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/delete[/:id]',
                             'constraints' => [
                                 'id'     => '[0-9]+',
                             ],
                            'defaults' => [
                                'controller' =>   Controller\PokemonController::class
                            ],
                        ],
                    ],
                    'signal' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/signal',
                            'defaults' => [
                                'controller' =>   Controller\PokemonController::class,
                                'action' => 'signal'
                            ],
                        ],
                    ],
                ],
                'may_terminate' => true,
            ],
        ],
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ]
];
