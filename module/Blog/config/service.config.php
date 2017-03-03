<?php

namespace Blog;

return [
    'invokables' => [
        'Blog\Repository\Repository' => 'Blog\Repository\PostRepositoryImpl'
    ],
    'factories' => [
        'Blog\Service\BlogService' => function(\Zend\ServiceManager\ServiceLocator $sl) {
            $blogService = new \Blog\Service\BlogServiceImpl();
            $blogService->setPostRepository($sl->get('Blog\RepRepository\PostRepository'));

            return $blogService;
        }
    ]
]
