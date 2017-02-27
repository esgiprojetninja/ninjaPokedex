<?php

namespace Blog;

return [
    'router' => [
        'routes' => [
            'blog_home' => [
                'type' => 'Literal',
                'options' => [
                    'route' => 'blog',
                    'defaults' => [
                        'controler' => 'Blog\Controller\Index',
                        'action'    => 'index'
                    ]
                ]
            ]
        ]
    ],

    'controllers' => [
        'factories' => [
            'Blog\Controller\Index' => 'Blog\Controller\IndexController'
        ]
    ],

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view'
        ]
    ]
];
