<?php 

namespace damianbal\QuizAPI\Core;

/**
 * Matches routes with server requested route and calls it
 */
class Router
{
    protected $routes = [];

    public function getRoutes()
    {
        return $this->routes;
    }

    protected function route($method, $path, $callback) 
    {
        $route = new Route($path, $method, $callback);

        $routes[] = $route;
    }

    public function get($path, $callback)
    {
        $this->route('GET', $path, $callback);
    }

    public function post($path, $callback) 
    {
        $this->route('POST', $path, $callback);
    }
}