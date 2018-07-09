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
    protected $method;

    public function setParams($params) {
        $this->params = $params;
    }

    public function getMethod() { return $this->method; }

    public function getPathInfo() { return $this->pathInfo; }

    public function param($key) { return $this->params[$key]; }

    public function input($name)
    {
        if($this->method == "GET") {
            return $_GET[$name];
        }
        else if($this->method == "POST") {
            return $_POST[$name];
        }
        else if($this->method == "PUT") {
            parse_str(file_get_contents("php://input"),$post_vars);
            return $post_vars[$name];
        }
        
        return "";
    }

    /**
     * Make request from $_SERVER variables
     */
    public function __construct()
    {
        $this->pathInfo = $_SERVER["PATH_INFO"];
        $this->method = $_SERVER["REQUEST_METHOD"];
    }
}