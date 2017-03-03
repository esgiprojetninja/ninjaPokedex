<?php

namespace Blog;

return [
    'invokables' => [
        'Blog\Repository\PostRepository' => 'Blog\Repository\PostRepositoryImpl'
    ],
    'factories' => [
        'Blog\Service\BlogService' => function(\Zend\ServiceManager\ServiceManager $sl) {
            $blogService = new \Blog\Service\BlogServiceImpl()  ;
            $blogService->setPostRepository( $sl->get('Blog\Repository\PostRepository') );

            return $blogService;
        }
    ],
    // initializers are called on every instantiation
    'initializers' => [
        function (\Zend\ServiceManager\ServiceLocatorInterface $sl, $instance) {
            if ( $instance instanceof \Zend\Db\AdapterAwareInterface ) {
                $instance->setDbAdapter( $sl->get('Zend\Db\Adapater\Adapter') );
            }
        }
    ]
];
