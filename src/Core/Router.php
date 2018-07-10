<?php 

namespace damianbal\QuizAPI\Core;

/**
 * Matches routes with server requested route and calls it
 */
class Router
{
    protected $routes = [];
    protected $request;

    public function getRoutes()
    {
        return $this->routes;
    }

    public function setRequest($request)
    {
        $this->request = $request;
    }

    protected function route($method, $path, $callback) 
    {
        $route = new Route($path, $method, $callback);

        $this->routes[] = $route;
    }

    public function get($path, $callback)
    {
        $this->route('GET', $path, $callback);
    }

    public function post($path, $callback) 
    {
        $this->route('POST', $path, $callback);
    }

    public function getParts($str)
    {
        return explode('/', trim($str, '/'));
    }

    public function checkIfPartsAreTheSame($requestParts, $routeParts)
    {
        $is_ok = false;

        $requestArr = [];
        $routeArr = [];

        if(count($requestParts) != count($routeParts)) return false;

        foreach ($requestParts as $key => $value) {
            $routePart = $routeParts[$key];

  

            if(@$routeParts[$key][0] != '@')
            {
                $requestArr[] = $value;
                @$routeArr[] = $routeParts[$key];
            }
        }

        $diff = array_diff($requestArr, $routeArr);

        

        if(count($diff) == 0) {
            $is_ok = true;
        }

        return $is_ok;
    }

    public function getParamsFromParts($requestParts, $routeParts)
    {
        $params = [];
        foreach($requestParts as $key => $value) {
            $r = $routeParts[$key];

            // it is param
            if($r[0] == '@')
            {
                // get key name
                $key = str_replace('@', '', $r);

                // set value
                $params[$key] = $value;
            }
        }
        return $params;
    }

    public function resolve()
    {
        // get request parts
        $requestParts = $this->getParts($this->request->getPathInfo());

        $selectedRoute = null;

        foreach($this->routes as $route) {
            if($route->method != $this->request->getMethod()) continue;

            $routeParts = $this->getParts($route->path);
            if($this->checkIfPartsAreTheSame($requestParts, $routeParts)) {
                $selectedRoute = $route;

                $this->request->setParams($this->getParamsFromParts($requestParts, $routeParts));
            }
        }

        return $selectedRoute;
    }
}