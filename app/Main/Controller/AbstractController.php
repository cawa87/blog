<?php

namespace Main\Controller;
/**
 * Description of AbstractController
 *
 * @author Cawa
 */
use Interfaces\Request;

abstract class AbstractController 
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
        } return null;
        
    }
    
    public function indexAction()
    {
        
    }
}
