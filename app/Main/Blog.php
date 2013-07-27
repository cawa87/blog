<?php

namespace Main;
/**
 * Main  Blog app
 *
 * @author Cawa
 */


class Blog 
{

    /*
     * Run this method to start the blog
     * 
     */
    public function run()
    {
        echo 'App is strated...<br />';
        $this->includeConfig();
        
    }
    
    public function includeConfig() 
    {
      if (ENVIRONMENT == 'dev') {
         require BASE_DIR . '/config/appConfig.local.php';
         require BASE_DIR . '/config/DoctrineConfig.local.php';
         echo 'config included... <br />';
      } else {
         require BASE_DIR . '/config/appConfig.php';
         require BASE_DIR . '/config/DoctrineConfig.php';
         echo 'config included... <br />';
      }
      echo 'env is ' . ENVIRONMENT . '... <br />';
   }
            
    
}
