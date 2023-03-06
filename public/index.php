<?php
require '../autoload.php';
require_once '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, '../.env.dev'); // define, then load the specified .env file
$dotenv->load();

$routes = new \PortfolioSite\Routes();
$entryPoint = new \Classes\EntryPoint($routes);
$entryPoint->run();
