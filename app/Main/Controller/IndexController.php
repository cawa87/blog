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
        var_dump($em->getEm()->find('Entity\Test',1));
    }
    
}
