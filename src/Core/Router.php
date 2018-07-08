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

        foreach ($requestParts  as $key => $value) {
            $routePart = $routeParts[$key];

            if($routePart == $value || $routePart[0] == '@') {
                $is_ok = true;
            }
            else {
                $is_ok = false;
            }
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




        // check if any of routes matches it
        foreach ($this->routes as $route) {
      
            $routeParts = $this->getParts($route->path);

    

            // check if length is same
            if(count($requestParts) != count($routeParts)) continue;

            $selectedRoute = $route;

            if($this->checkIfPartsAreTheSame($requestParts, $routeParts)) {
                echo "JEST OK: " . $route->path;

                $params = $this->getParamsFromParts($requestParts, $routeParts);
                foreach ($params as $key => $param) {
                    echo "<div>$key -> $param</div>";
                }
                $this->request->setParams($params);
                break;
            }
            else {
                $selectedRoute = null;
            }


        }

        return $selectedRoute;
    }
}