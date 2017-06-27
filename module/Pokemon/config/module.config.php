<?php
namespace Pokemon;
return [
    'controllers' => [
        'factories' => [
            'Pokemon\Controller\Pokemons' => 'Pokemon\Controller\PokemonsControllerFactory',
        ],
    ],
    'router' => [
        'routes' => [
            'pokemons' => [
                'type'    => 'Segment',
                'options' => [
                   'route'    => '/pokemons[/:id]',
                    'constraints' => [
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => 'Pokemon\Controller\Pokemons',
                    ],
                ],
                'child_routes' => [
                    'update' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'    => '/update[/:id]',
                             'constraints' => [
                                 'id'     => '[0-9]+',
                             ],
                            'defaults' => [
                                'controller' => 'Pokemon\Controller\Pokemons'
                            ],
                        ],
                    ],
                    'create' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/create',
                            'defaults' => [
                                'controller' => 'Pokemon\Controller\Pokemons'
                            ],
                        ],
                    ],
                    'delete' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'    => '/delete[/:id]',
                             'constraints' => [
                                 'id'     => '[0-9]+',
                             ],
                            'defaults' => [
                                'controller' => 'Pokemon\Controller\Pokemons'
                            ],
                        ],
                    ],
                    'marked' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/marked',
                            'defaults' => [
                                'controller' => 'Pokemon\Controller\Pokemons',
                                'action' => 'marked'
                            ],
                        ],
                    ],
                    'signal' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route' => '/signal',
                            'verb'  => 'post,put',
                            'defaults' => [
                                'controller' => 'Pokemon\Controller\Pokemons',
                                'action' => 'signal'
                            ],
                        ],
                    ],
                    'marked' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/marked',
                            'defaults' => [
                                'controller' => 'Pokemon\Controller\Pokemons',
                                'action' => 'marked'
                            ],
                        ],
                    ]
                ],
                'may_terminate' => true,
            ],
        ],
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
