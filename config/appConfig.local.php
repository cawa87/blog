<?php

/*
 * main config for blog-app
 * 
 */

return [
    'app' => [
        'router' => [
            'index' => [
                'controller' => 'IndexController',
                'params' => 'id'
            ],
            'test' =>[
                'controller' => 'TestController'
            ]
        ]
    ],
    'doctrine' => [
        'driver' => 'pdo_mysql',
        'user' => 'root',
        'password' => '',
        'dbname' => 'blog',
        'charset' => 'utf8',
        'proxyDir' => '/data/Proxy',
        'entityDir' => '/app/Entity'
    ]
];
