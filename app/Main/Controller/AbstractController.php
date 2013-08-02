<?php

namespace Main\Controller;
/**
 * Description of AbstractController
 *
 * @author Cawa
 */
use Exception\ActionNotFoundException;
        


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
        } $this->notFoundActin();
        
    }
    
    public function indexAction()
    {
        
    }
    
    public function notFoundActin()
    {
        throw new ActionNotFoundException();
    }
}
