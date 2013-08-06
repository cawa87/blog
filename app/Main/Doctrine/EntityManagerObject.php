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

        $em = EntityManager::create($config, $doctrineConfig);
        
        $this->setEm($em);
    }
    
        public function serialize($entity)
    {
        $className = get_class($entity);

        $uow = $this->getEm()->getUnitOfWork();
        $entityPersister = $uow->getEntityPersister($className);
        $classMetadata = $entityPersister->getClassMetadata();

        $result = array();
        foreach ($uow->getOriginalEntityData($entity) as $field => $value) {
            if (isset($classMetadata->associationMappings[$field])) {
                $assoc = $classMetadata->associationMappings[$field];

                // Only owning side of x-1 associations can have a FK column.
                if ( ! $assoc['isOwningSide'] || ! ($assoc['type'] & \Doctrine\ORM\Mapping\ClassMetadata::TO_ONE)) {
                    continue;
                }

                if ($value !== null) {
                    $newValId = $uow->getEntityIdentifier($value);
                }

                $targetClass = $this->em->getClassMetadata($assoc['targetEntity']);
                $owningTable = $entityPersister->getOwningTable($field);

                foreach ($assoc['joinColumns'] as $joinColumn) {
                    $sourceColumn = $joinColumn['name'];
                    $targetColumn = $joinColumn['referencedColumnName'];

                    if ($value === null) {
                        $result[$sourceColumn] = null;
                    } else if ($targetClass->containsForeignIdentifier) {
                        $result[$sourceColumn] = $newValId[$targetClass->getFieldForColumn($targetColumn)];
                    } else {
                        $result[$sourceColumn] = $newValId[$targetClass->fieldNames[$targetColumn]];
                    }
                }
            } elseif (isset($classMetadata->columnNames[$field])) {
                $columnName = $classMetadata->columnNames[$field];
                $result[$columnName] = $value;
            }
        }

        return array($className, $result);
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
