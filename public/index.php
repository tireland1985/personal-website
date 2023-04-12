<?php
require '../autoload.php';
require_once '../vendor/autoload.php';

// define and load the relevant environment variables from the specified file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '../.env.dev'); 
$dotenv->load();

$routes = new \PortfolioSite\Routes();
$entryPoint = new \Classes\EntryPoint($routes);
$entryPoint->run();
