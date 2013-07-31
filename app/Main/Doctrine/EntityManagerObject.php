<?php

namespace Main\Doctrine;
/**
 * Description of EntityManager
 *
 * @author Cawa
 */
use Main\Config\ConfigReader,
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\Configuration,
    Doctrine\Common\Cache\ArrayCache as Cache,
    Doctrine\Common\Annotations\AnnotationRegistry;


class EntityManagerObject
{
    
    protected $em;
    
    public function __construct() 
    {
        $config = ConfigReader::readConfig('doctrine');
        //configuration
        $doctrineConfig = new Configuration();
        $cache = new Cache();
        $doctrineConfig->setQueryCacheImpl($cache);
        $doctrineConfig->setProxyDir($config['proxyDir']);
        $doctrineConfig->setProxyNamespace('Proxy');
        $doctrineConfig->setAutoGenerateProxyClasses(true);
        $doctrineConfig->setResultCacheImpl($cache);
        //mapping (example uses annotations, could be any of XML/YAML or plain PHP)
        AnnotationRegistry::registerFile(BASE_DIR . '/vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');
        $driver = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver(
                new \Doctrine\Common\Annotations\AnnotationReader(), array($config['entityDir'])
        );
        $doctrineConfig->setMetadataDriverImpl($driver);
        $doctrineConfig->setMetadataCacheImpl($cache);

         $em = EntityManager::create(array(
            'driver' => 'pdo_mysql',
            'user' => 'root',
            'password' => 'cawa123azs',
            'dbname' => 'blog',
            'charset' => 'utf8')
                , $doctrineConfig
        );
         
        $this->setEm($em);
        
    }     
        public function setEm(EntityManager $em)
        {
            $this->em = $em;
        }
        
        public function getEm() 
        {
            return $this->em;
        }
    
    
}
