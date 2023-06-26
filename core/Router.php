<?php

namespace app\core;

// class Router2
// {
//     protected array $routes = [];
//     public function get($path, $callback)
//     {
//         $this->routes['get'][$path] = $callback;
//     }

//     public function resolve()
//     {
//         echo "<pre>";
//         var_dump(@$_SERVER);
//         echo "</pre>";
//         exit
//     }
// }

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
    public function get($path, $call)
    {
        $this->routes["get"][$path]=$call;
    }
    public function post($path, $call)
    {
        $this->routes["post"][$path]=$call;
    }

    public function resolve()
    {
        // $this->request->getPath()
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if($callback === false)
        {
            $this->response->setStatusCode(404);
            $callback = '_404';
        //    return $this->renderContent("Not Found");
        //    $this->renderView($callback)
        }
        if(is_string($callback))
        {
            return $this->renderView($callback);
        }
        if(is_array($callback))
        {
            Application::$app->controller = new $callback[0]();
            $callback[0] =  Application::$app->controller;
        }
        return call_user_func($callback, $this->request);


        echo "<pre>";
        var_dump($method);
        var_dump($path);
        var_dump($callback);
        echo"</pre>";
        exit;
    }

    public function renderContent($content)
    {
        $layoutContent = $this->layoutContent('main');
        $viewContent = $content;
       return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent('main');
        $viewContent = $this->renderOnlyView($view, $params);
       return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent($layout = "main")
    {
        if(isset(Application::$app->controller)){
            $layout2 = Application::$app->controller->layout;
        }else {
            $layout2 = $layout;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/$layout2.php";
        return ob_get_clean();

    }

    protected function renderOnlyView($view, $params = [])
    {
        foreach($params as $key => $value)
        {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}

