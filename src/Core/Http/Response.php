<?php 

namespace damianbal\QuizAPI\Core\Http;


class Response
{
    public $body = "";
    public $code = 200;
    public $contentType;

    /**
     * Set output
     *
     * @param string $body
     * @return void
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Set status code
     *
     * @param mixed $code
     * @return void
     */
    public function setStatusCode($code)
    {
        $this->code = $code;
    }

    /**
     * Set the content type json, xml, etc..
     *
     * @param [type] $contentType
     * @return void
     */
    public function setContentType($contentType) {
        $this->contentType = $contentType;
    }

    /**
     * Dispatch the response
     *
     * @return void
     */
    public function dispatch()
    {
        header('X-PHP-Response-Code: ' . $this->code, true, $this->code);
 
        if($this->contentType != null)
        {
            header('Content-Type: application/' . $this->contentType);
        }

        if($this->contentType == null) { 
            echo $this->body;
        }
        else {
            echo json_encode($this->body);
        }
    }

    public static function response($body, $code = 200)
    {
        $r = new Response();
        $r->setStatusCode($code);
        $r->setBody($body);
        return $r;
    }

    public static function responseJson($data, $code = 200)
    {
        $r = new Response();
        $r->setStatusCode($code);
        $r->setBody($data);
        $r->setContentType('json');
        return $r;
    }
}