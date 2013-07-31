<?php

namespace Main\Config;
/**
 * Description of Config
 *
 * @author Cawa
 */
class ConfigReader
{

    public static function readConfig($selection = 'app') 
    {
        
        if (ENVIRONMENT == 'dev') {
            $config = require BASE_DIR . '/config/appConfig.local.php';
            
        } else {
            $config = require BASE_DIR . '/config/appConfig.php';
        }
        throw new \Exception\WrongArgumentException();
        return $config[$selection];
    }
    
}
