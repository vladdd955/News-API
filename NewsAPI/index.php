<?php

require_once "vendor/autoload.php";


use App\Controllers\ApiController;


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $rout) {
    $rout->addRoute('GET',"/", [ApiController::class, $_GET['search'] ?? "Covid"]);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // ... call $handler with $vars
        [$controller, $method] = $handler;
        $ApiController=new $controller($method,$dotenv);
        break;
}

?>







