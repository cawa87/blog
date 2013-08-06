<?php

namespace Main\Controller;
/**
 * Description of IndexController
 *
 * @author Cawa
 */
use Main\Doctrine\EntityManagerObject;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        $em = new EntityManagerObject();
        $test = $em->getEm()->find('\Entity\TestEntity',1);
        $array = $em->serialize($test);
        echo json_encode(array_pop($array));
        
    }
    
    public function testAction()
    {
        var_dump($this->arguments);
    }
    
}
