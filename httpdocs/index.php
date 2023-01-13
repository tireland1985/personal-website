<?php
require '../autoload.php';

$routes = new \PortfolioSite\Routes();
$entryPoint = new \Classes\EntryPoint($routes);
$entryPoint->run();
