<?php 

namespace damianbal\QuizAPI\Core\Http;

/**
 * Class which will be passed as argument for callback in router
 *
 */
class Request
{
    protected $params = [];
    protected $pathInfo;

    /**
     * Make request from $_SERVER variables
     */
    public function __construct()
    {
        $this->pathInfo = $_SERVER["PATH_INFO"];
    }
}