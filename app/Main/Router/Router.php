<?php
/**
 * @author Cawa
 * The routing class
 */
namespace Main\Router;


use Main\Request\Request;


class Router 
{

    protected $config;
    
    /**
     * 
     * @param array $config
     * @return type Main\Request\Request
     */
    public function __construct(Array $config) 
    {
        $this->config = $config;
    }
    
    public function process() 
    {
        $params = [];
        
        $uri = $_SERVER['REQUEST_URI'];
        $tmp = parse_url($uri);
        $urlParam = array_filter(explode('/', str_replace('.php', '', $tmp['path'])));
        
        $controller = $urlParam[1];
        $action = $urlParam[2];
        $args = explode('&', $tmp['query']);
        
        if (array_key_exists($controller, $this->config)) {
            $params['controller'] = ucfirst($controller).'Controller';
            $params['action'] = $action.'Action';
            $params['args'] = $args;
        }

        return new Request($params);
        
    }
    
}