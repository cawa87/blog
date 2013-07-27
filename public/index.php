<?php

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

//create constant for project dir
define('BASE_DIR', dirname(__DIR__));

require '/vendor/autoload.php';

//define environment dev/prod
if (is_readable('config/appConfig.local.php') && is_readable('config/DoctrineConfig.local.php')) {
    define('ENVIRONMENT', 'dev');
} else {
    define('ENVIRONMENT', 'prod');
}


// run the app
$blog = new Main\Blog();
$blog->run();