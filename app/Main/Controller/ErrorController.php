<?php

namespace Main\Controller;
/**
 * Description of IndexController
 *
 * @author Cawa
 */
use Main\Doctrine\EntityManagerObject;

class ErrorController
{
    public function __construct($code = 0) 
    {
        echo 'Error code:' . $code;
    }
    
}
