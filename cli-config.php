<?php

/*
* @description doctrine Doctrine ORM config
* @author CawaKharkov
*/

use Doctrine\ORM\EntityManager,
    Doctrine\ORM\Configuration,
    Doctrine\Common\Cache\ArrayCache as Cache,
    Doctrine\Common\Annotations\AnnotationRegistry;

//configuration
$doctrineConfig = new Configuration();
$cache = new Cache();
$doctrineConfig->setQueryCacheImpl($cache);
$doctrineConfig->setProxyDir(__DIR__.'/data/Proxy');
$doctrineConfig->setProxyNamespace('Proxy');
$doctrineConfig->setAutoGenerateProxyClasses(true);
$doctrineConfig->setResultCacheImpl($cache);
//mapping (example uses annotations, could be any of XML/YAML or plain PHP)
AnnotationRegistry::registerFile('vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');
$driver = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver(
        new \Doctrine\Common\Annotations\AnnotationReader(), array(__DIR__ . '/app/Entity')
);
$doctrineConfig->setMetadataDriverImpl($driver);
$doctrineConfig->setMetadataCacheImpl($cache);


//getting the EntityManager
$entityManager = EntityManager::create(
                array(
            'driver' => 'pdo_mysql',
            'user' => 'root',
            'password' => 'cawa123azs',
            'dbname' => 'blog',
            'charset' => 'utf8'
                ), $doctrineConfig
);

$helpers = new Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($entityManager->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($entityManager)
));