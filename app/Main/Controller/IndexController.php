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
        $this->view =  '1';
        
    }
    
    public function testAction()
    {
        var_dump($this->arguments);
    }
    
}
