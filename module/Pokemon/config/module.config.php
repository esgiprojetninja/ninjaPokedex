<?php
namespace Pokemon;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
            'Pokemon\Controller\Pokemons' => 'Pokemon\Controller\PokemonsControllerFactory',
            'Pokemon\Controller\Admin' => 'Pokemon\Controller\AdminControllerFactory',
        ],
    ],
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
                        'controller' => 'Pokemon\Controller\Pokemons',
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
                                'controller' => 'Pokemon\Controller\Pokemons'
                            ],
                        ],
                    ],
                    'create' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/create',
                            'defaults' => [
                                'controller' => 'Pokemon\Controller\Pokemons'
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
                                'controller' => 'Pokemon\Controller\Pokemons'
                            ],
                        ],
                    ],
                    'marked' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/marked',
                            'defaults' => [
                                'controller' => 'Pokemon\Controller\Pokemons',
                                'action' => 'marked'
                            ],
                        ],
                    ],
                    'signal' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route' => '/signal',
                            'verb'  => 'post',
                            'defaults' => [
                                'controller' => 'Pokemon\Controller\Pokemons',
                                'action' => 'signal'
                            ],
                        ],
                    ],
                    'marked' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/marked',
                            'verb'  => 'get',
                            'defaults' => [
                                'controller' => 'Pokemon\Controller\Pokemons',
                                'action' => 'marked'
                            ],
                        ],
                    ]
                ],
                'may_terminate' => true,
            ],
            'admin_home' => [
                'type'    => Literal::class,
                'options' => [
                   'route'    => '/admin',
                    'defaults' => [
                        'controller' => 'Pokemon\Controller\Admin',
                        'action' => 'index',
                    ],
                ],
                'child_routes' => [
                    'admin_list_pokemons' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/pokemons',
                            'defaults' => [
                                'controller' => 'Pokemon\Controller\Admin',
                                'action' => 'index'
                            ],
                        ],
                    ],
                    'add_admin' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/add',
                            'defaults' => [
                                'controller' => 'Pokemon\Controller\Admin',
                                'action' => 'addAdmin'
                            ],
                        ],
                    ],
                    'admin_login' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/login',
                            'defaults' => [
                                'controller' => 'Pokemon\Controller\Admin',
                                'action' => 'login'
                            ],
                        ],
                    ],
                    'admin_logout' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/logout',
                            'defaults' => [
                                'controller' => 'Pokemon\Controller\Admin',
                                'action' => 'logout'
                            ],
                        ],
                    ],
                    'admin_pokemon_show' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/pokemon/show/:id',
                            'constraints' => [
                                'id' => '[0-9]+'
                            ],
                            'verb'  => 'get',
                            'defaults' => [
                                'controller' => 'Pokemon\Controller\Admin',
                                'action' => 'showPokemon'
                            ],
                        ],
                    ],
                    'admin_pokemon_edit' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/pokemon/edit/:id',
                            'constraints' => [
                                'id' => '[0-9]+'
                            ],
                            'verb'  => 'get, post',
                            'defaults' => [
                                'controller' => 'Pokemon\Controller\Admin',
                                'action' => 'updatePokemon'
                            ],
                        ],
                    ],
                    'admin_pokemon_remove' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/pokemon/delete/:id',
                            'constraints' => [
                                'id' => '[0-9]+'
                            ],
                            'verb'  => 'get',
                            'defaults' => [
                                'controller' => 'Pokemon\Controller\Admin',
                                'action' => 'deletePokemon'
                            ],
                        ],
                    ],
                ],
                'may_terminate' => true
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
