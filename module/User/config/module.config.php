<?php
namespace User;
return [
    'router' => [
        'routes' => [
            'add_user' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/user/add',
                    'defaults' => [
                        'controller' => 'User\Controller\Index',
                        'action'  => 'add'
                    ]
                ]
            ],
            'login' => [
                'type' => 'Literal',
                'options' => [
                    'route' => 'user/login',
                    'defaults' => [
                        'controller' => 'User\Controller\Index',
                        'action'  => 'login'
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
