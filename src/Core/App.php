<?php 

namespace damianbal\QuizAPI\Core;

use damianbal\QuizAPI\Core\Http\Request;

class App 
{
    protected $router = null;

    public function __construct($router = null)
    {
        $this->router = $router;
    }

    public function run()
    {
        //
        $request = new Request();


    }
}