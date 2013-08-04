<?php

namespace Main;

/**
 * Main  Blog app
 *
 * @author Cawa
 */

use Doctrine\ORM\EntityManager,
    Main\Router\Router,
    Interfaces\RequestInterface,
    Main\Config\ConfigReader,
    Main\Controller\ErrorController;


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
        try {
        $this->config = ConfigReader::readConfig('app');
        }  catch (\Exception\ConfigSectionException $e){
            $e->displayErrors();
        }
        $request = $this->processRqst();
        
        $content = $this->startController($request);
        ob_start();
        include BASE_DIR.'/app/views/layout/default.phtml';
        
        $tmp = ob_get_clean();
        
        echo $tmp;

    }

    /**
     * 
     * @return type Request
     * @throws WrongArgumentException
     */
    public function processRqst() 
    {
        try {
            $routeConfig = $this->getConfig();

            $router = new Router($routeConfig['router']);
            $request = $router->process();
        } catch (\Exception\WrongArgumentException $e) {
            $e->displayErrors();
        }
        return $request;
    }

    
    /**
     * 
     * @param \Interfaces\RequestInterface $request
     * @return type Controller
     * @throws WrongControllerException
     * @throws ActionNotFoundException
     */
    public function startController(RequestInterface $request)
    {
        try {
            $controller = 'Main\Controller\\' . $request->getController();
            $controllerInstance = class_exists($controller) ?
                    new $controller($request->getAction(), $request->getArgumets()) :
                    new ErrorController('404');
        } catch (\Exception\WrongControllerException $e) {
            $e->displayErrors();
        } catch (\Exception\ActionNotFoundException $e) {
            $e->displayErrors();
        }
        return $controllerInstance->getView();
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
