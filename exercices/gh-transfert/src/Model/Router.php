<?php

namespace App\Model;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;

class Router
{
    private array $routes;

    public function addRoute($httpMethod, $route, $handler)
    {
        $this->routes[] = ['httpMethod' => $httpMethod, 'route' => $route, 'handler' => $handler];
    }

    public function create()
    {
        $dispatcher = \FastRoute\simpleDispatcher(function (RouteCollector $r) {
            foreach ($this->routes as $route) {
                $r->addRoute($route['httpMethod'], $route['route'], $route['handler']);
            }
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
            case Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                echo "404 - not found";
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                dump($routeInfo);
                // ... 405 Method Not Allowed
                echo "405 Method Not Allowed";
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                // ... call $handler with $vars
                $class = $handler[0];
                $action = $handler[1];
                $controller = new \ReflectionClass($class);
                $instance = $controller->newInstanceArgs([]);
                $response =  call_user_func_array(
                    [$instance, $action] // callable
                    ,
                    [$vars]
                );
                echo $response->getContent();
                break;
        }
    }
}
