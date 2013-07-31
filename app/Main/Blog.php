<?php

namespace Main;

/**
 * Main  Blog app
 *
 * @author Cawa
 */

use Doctrine\ORM\EntityManager,
    Main\Router\Router,
    Main\Config\ConfigReader;

class Blog
{
    /**
     *
     * @var type array
     */
    protected $config = [];
    
    /**
     *
     * @var type Doctrine\ORM\EntityManager
     */
    protected $em;

    /*
     * Run this method to start the blog
     */
    public function run()
    {
        $this->config = ConfigReader::readConfig('app');
        
        $requset = $this->processRqst();

    }

    public function processRqst() 
    {
        $routeConfig = $this->getConfig();
        $router = new Router($routeConfig['router']);
        $request = $router->process();
        var_dump($request);
        $controller = 'Main\\Controller\\'.$request->getController();
        $controllerInstance = new $controller($request->getAction(),$request->getArgumets());
    }

    /**
     * Get app configuration
     * @return type array
     */
    public function getConfig()
    {
        return $this->config;
    }
    
}
