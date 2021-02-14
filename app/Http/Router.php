<?php namespace App\Http;

class Router{

    public array $getRoutes = array();
    public array $postRoutes = array();

    /**
     * Defines get routes of the applcation
     * 
     * @param string $uri the request uri
     * @param mixed the callable type
     * 
     * @return void
     */
    public function get(string $uri, $callable)
    {
        $this->getRoutes[$uri] = $callable;
    }

    /**
     * Defines get routes of the applcation
     * 
     * @param string $uri the request uri
     * @param mixed the callable type
     * 
     * @return void
     */
    public function post(string $uri, $callable)
    {
        $this->postRoutes[$uri] = $callable;
    }


    public function resolve()
    {
        $pathInfo = $_SERVER['PATH_INFO'] ?? "/";

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                $callable = $this->postRoutes[$pathInfo] ?? null;
                break;
            case 'GET':
                $callable = $this->getRoutes[$pathInfo] ?? null;
                break;
        }

        if (empty($callable)) {
            die("<h1>404</h1>");
        }else{
            call_user_func($callable, $this);
        }
    }

    /**
     * Renders a view file
     * 
     * @param string $viewName the view you want to render without '.php'
     */
    public function render($viewName, array $data = array())
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        
        ob_start();

        include_once(__DIR__ . "/../../views/$viewName.php");

        $content = ob_get_clean();

        include_once(__DIR__ . "/../../views/layouts/app.php");

        \resetPage();
    }

}