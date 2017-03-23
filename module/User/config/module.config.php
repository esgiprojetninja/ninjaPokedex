<?php
namespace User;
return [
    'router' => [
        'routes' => [
            'user_home' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/user',
                    'defaults' => [
                        'controller' => 'User\Controller\Index',
                        'action' => 'index'
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'factories' => [
            'User\Controller\Index' => 'User\Controller\IndexControllerFactory'
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view'
        ]
    ]
];
