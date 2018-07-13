<?php 

namespace damianbal\QuizAPI\Core;

use damianbal\QuizAPI\Core\Http\Request;
use damianbal\QuizAPI\Core\Http\Response;

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

           $route->run($request);
       } else {
           return Response::response("Method not allowed or route doesn't exist!");
       }

    }
}