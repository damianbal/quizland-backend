<?php 

namespace damianbal\QuizAPI\Core;

use damianbal\QuizAPI\Core\Http\Request;

class App 
{
    protected $router ;

    public function __construct($router = null)
    {
        $this->router = $router;
    }

    public function run()
    {
        
        $request = new Request();

        $this->router->setRequest($request);

        $route = $this->router->resolve();

       // $route->run($request);
       if($route != null) {
            // TODO: check if route is same method as request if it is then we can procceed if not then call response with http code error

           $route->run($request);
       }

    }
}