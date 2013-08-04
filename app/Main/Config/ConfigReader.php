<?php

namespace Main\Config;
/**
 * Description of Config
 *
 * @author Cawa
 */
class ConfigReader
{

    public static function readConfig($seletion = 'app') 
    {
       
        $config = (ENVIRONMENT == 'dev') ?
                require BASE_DIR . '/config/appConfig.local.php' :
                require BASE_DIR . '/config/appConfig.php';

        return $config[$seletion];
    }
    
}
