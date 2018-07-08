<?php 

namespace damianbal\QuizAPI\Core;

use damianbal\QuizAPI\Core\Http\Request;


/**
 * Route specifies path to route, method and callback 
 */
class Route
{
    public $path;
    public $method;
    public $callback;

    public function __construct($path, $method, $callback)
    {
        $this->path = $path;
        $this->method = $method;
        $this->callback = $callback;
    }

    public function run(Request $request = null)
    {
        $response = null;

        // check if route is a anonymous or callback
        if(is_callable($this->callback))
        {
            // call it passing request
            $response = call_user_func($this->callback, $request);
        }
        else // string path to controller and method
        {
            $parts = explode('@', $this->callback);

            $controller_name = $parts[0];
            $method_name = $parts[1];

            $controller = new $controller_name();
            $response = $controller->{$method_name}($request);
        }

        if($response != null)
        {
            $response->dispatch();
        }
    }
}

