<?php
require '../autoload.php';
require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '../.env.dev'); // define, then load the specified .env file
$dotenv->load();

//initialise HTMLPurifier (testing)
require_once '../vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
$config = HTMLPurifier_HTML5Config::createDefault();
//$config = \HTMLPurifier_Config::createDefault();
//Allow only basic tags
$config->set('HTML.Allowed', 'p,b,a[href],i, ul, li');
$purifier = new \HTMLPurifier($config);

$routes = new \PortfolioSite\Routes();
$entryPoint = new \Classes\EntryPoint($routes);
$entryPoint->run();
