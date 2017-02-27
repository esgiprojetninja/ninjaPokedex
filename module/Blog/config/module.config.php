<?php

namespace Blog;

return [
    'router' => [
        'routes' => [
            'blog_home' => [
                //match exactement
                'type' => 'Literal',
                'options' => [
                    'route' => '/blog',
                    'defaults' => [
                        'controller' => 'Blog\Controller\Index',
                        'action' => 'index'
                    ]
                ]
            ]
        ],

        'controllers' => [
            'factories' => [
                'Blog\Controller\Index' => 'Blog\Controller\IndexControllerFactory'
            ]
        ],

        'view_manager' => [
            'template_path_stack' => [
                __DIR__ . '/../view'
            ]
        ]
    ]
];
