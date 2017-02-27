<?php
namespace Blog;
return [
    'router' => [
        'routes' => [
            'blog_home' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/blog',
                    'defaults' => [
                        'controller' => 'Blog\Controller\Index',
                        'action'    => 'index'
                    ]
                ]
            ],
            'blog_add' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/blog/post/add',
                    'defaults' => [
                        'controller' => 'Blog\Controller\Index',
                        'action'    => 'add'
                    ]
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
];
