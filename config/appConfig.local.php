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
        'password' => 'cawa123azs',
        'dbname' => 'blog',
        'charset' => 'utf8',
        'proxyDir' => '/data/Proxy',
        'entityDir' => '/app/Entity'
    ]
];