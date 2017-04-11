<?php
namespace Pokedex;
return [
    'router' => [
        'routes' => [
            'blog_home' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/pokedex',
                    'defaults' => [
                        'controller' => 'Pokedex\Controller\Index',
                        'action'    => 'index'
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'factories' => [
            'Pokedex\Controller\Index' => 'Pokedex\Controller\IndexControllerFactory'
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view'
        ]
    ]
];
