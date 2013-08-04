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
       
        $config = (ENVIRONMENT == 'dev') ?
                require BASE_DIR . '/config/appConfig.local.php' :
                require BASE_DIR . '/config/appConfig.php';

        return $config[$selection];
    }
    
}
