<?php

namespace Main;

error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);

/**
 * Test bootstrap, for setting up autoloading
 */
class Bootstrap
{

    public static function init()
    {
        require '../vendor/autoload.php';
        chdir(dirname(__DIR__));

        //create constant for project dir
        define('BASE_DIR', dirname(__DIR__));
        //define environment dev/prod
        if (is_readable('config/appConfig.local.php')) {
            define('ENVIRONMENT', 'dev');
        } else {
            define('ENVIRONMENT', 'prod');
        }
    }


    
}

Bootstrap::init();