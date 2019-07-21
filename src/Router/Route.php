<?php


namespace DBMOVIE\Router;


class Route
{
    private $page;
    private $method;
    private $params;

    /**
     * Route constructor.
     * @param string $request
     */
    public function __construct($request)
    {
        $this
            ->setPage($request)
            ->setMethod($request)
            ->setParams($request);
    }


    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param $request
     * @return Route
     */
    public function setPage($request)
    {
        $elements = explode('/', $request);
        $this->page = $elements[0];
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param $request
     * @return Route
     */
    public function setMethod($request)
    {
        $elements = explode('/', $request);
        if (count($elements) > 1):
            $this->method = $elements[1];
        else:
            $this->method = null;
        endif;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param $request
     * @return Route
     */
    public function setParams($request)
    {
        $elements = explode('/', $request);
        if (count($elements) > 2):
            $this->params = $elements[2];
        else:
            $this->params = null;
        endif;
        return $this;
    }
}