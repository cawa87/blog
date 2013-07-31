<?php

namespace Main;

/**
 * Main  Blog app
 *
 * @author Cawa
 */

use Doctrine\ORM\EntityManager,
    Main\Router\Router;

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
        $this->config = $this->includeConfig();
        $requset = $this->processRqst();

    }

    /**
     * Including the app config.
     * @return type array 
     */
    protected function includeConfig()
    {
        $config = [];
        if (ENVIRONMENT == 'dev') {
            $config = array_merge($config,require BASE_DIR . '/config/appConfig.local.php');
            require BASE_DIR . '/config/DoctrineConfig.local.php';
            $this->setEm($entityManager);
        } else {
            require BASE_DIR . '/config/appConfig.php';
            require BASE_DIR . '/config/DoctrineConfig.php';
        }
        return $config;
    }

    
    public function processRqst() 
    {
        $routeConfig = $this->getConfig();
        $router = new Router($routeConfig['router']);
        $request = $router->process();
        $controller = 'Main\\Controller\\'.$request->getController();
        $controllerInstance = new $controller($request->getAction(),$request->getArgumets());
        var_dump($controllerInstance);
    }

    /**
     * Set the Doctrine EntityManager
     * @param \Doctrine\ORM\EntityManager $em\
     */
    public function setEm(EntityManager $em)
    {
        $this->em = $em;
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
