<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

//create constant for project dir
define('BASE_DIR', dirname(__DIR__));

require '/vendor/autoload.php';
require 'config/DoctrineConfig.php';

// run the app
Main\Blog::run();
//$entityManager->getRepository('Entity\Test');
$test = new Entity\Test();
$test->setText('asdasdsad');
//$entityManager->persist($test);
//$entityManager->flush();

$first = $entityManager->getRepository('Entity\Test')->find(1);
var_dump($first->setCreated(date()));
var_dump($first->getCreated());