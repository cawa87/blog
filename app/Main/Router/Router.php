<?php

namespace Main\Router;

class Router {

   private $d_controller = 'Main';
   private $d_controller = 'indexAction';

   private function getRequest() 
   {
      $uri = isset($_SERVER['REQUEST_URI']) ? trim($_SERVER['REQUEST_URI'], '/') : array();
      if (strpos('?', $uri)) // Если есть GET запросы то обрезаем ссылку до них чтобы они работали и не мешали открывать нужную ссылку
         $uri = substr($uri, 0, strpos('?', $uri));
      if (strpos('.html', $uri)) // Если окончание ссылки .html то обрезаем 
         $uri = substr($uri, 0, strpos('.html', $uri));
      return $uri;
   }

   public function appRun() 
   {
      $uri = $this->getRequest();
      $controller = !empty($uri[0]) ? ucfirst($uri[0]) : $this->d_controller;
      $action = !empty($uri[1]) ? ucfirst($uri[1]) . 'Action' : $this->d_action;
      if (!empty($splits[2])) {
         $keys = $values = array();
         for ($i = 2, $cnt = count($splits); $i < $cnt; $i++) {
            if ($i % 2 == 0)
               $keys[] = $splits[$i];
            else
               $values[] = $splits[$i];
         }
         if ($keys && $values)
            $params = array_combine($keys, $values);
         else
            $params = $keys;
      }
      else
         $params = false;
      if (file_exists('..Путь не знаю куда..' . $controller . '.php')) {
         include '..Путь не знаю куда..' . $controller . '.php';
         if (class_exists($controller)) {
            $controller = new $controller();
            if (method_exists($controller, $action)) {
               return $controller->{$action}($params);
            }
            else
               die('error method in class not found');
         }
         else
            die('error class not found');
      }
      else
         die('not found');
   }

}