<?php

namespace Main\Controller;
/**
 * Description of AbstractController
 *
 * @author Cawa
 */
use Interfaces\Request;

class AbstractController 
{
    protected $arguments = [];


    protected function dispatch($request)
    {
        var_dump($request);
    }
    
    public function __construct($action,$args) 
    {
         if (method_exists($this, $action)) {
             $this->arguments = $args;
            return $this->$action();
        } else {
            //oh dear - handle this situation in whatever way
            //is appropriate
            return null;
        }
    }
    
    public function indexAction()
    {
        
    }
}
