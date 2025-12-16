<?php

namespace Framework;

use App\Controllers\ErrorController;

class Router
{
    protected $routes = [];

    /**
     * Add a new route
     * 
     * @param string $method
     * @param string $uri
     * @param string $actiion
     * @return void
     */

    public function registerRoute($method, $uri, $action)
    {

        list($controller, $controllerMethod) = explode('@', $action);

        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod
        ];
    }

    /**
     * adding a GET route
     * 
     * @param string $uri
     * @param string $controller
     * 
     * @return void
     */

    public function get($uri, $controller)
    {
        $this->registerRoute('GET', $uri, $controller);
    }

    /**
     * adding a POST route
     * 
     * @param string $uri
     * @param string $controller
     * 
     * @return void
     */

    public function post($uri, $controller)
    {
        $this->registerRoute('POST', $uri, $controller);
    }

    /**
     * adding a PUT route
     * 
     * @param string $uri
     * @param string $controller
     * 
     * @return void
     */

    public function put($uri, $controller)
    {
        $this->registerRoute('PUT', $uri, $controller);
    }

    /**
     * adding a DELETE route
     * 
     * @param string $uri
     * @param string $controller
     * 
     * @return void
     */

    public function delete($uri, $controller)
    {
        $this->registerRoute('DELETE', $uri, $controller);
    }

    /**
     * Route the request
     * @param string $uri
     * @param string $method
     * 
     * @return void
     */

    public function route($uri)
    {

        $requestMethod = $_SERVER['REQUEST_METHOD'];

        //check for method input

        if ($requestMethod == 'POST' && isset($_POST['_method'])) {
            $requestMethod = strtoupper($_POST['_method']);
        }

        foreach ($this->routes as $route) {

            //split the current URI into segments
            $uriSegments = explode('/', trim($uri, '/'));

            //split the route URI into segments
            $routeSegments = explode('/', trim($route['uri'], '/'));

            $match = true;

            //check if the number of segments matches
            if (count($uriSegments) === count($routeSegments) && strtoupper($route['method']) === $requestMethod) {
                $params = [];

                $match = true;

                for ($i = 0; $i < count($uriSegments); $i++) {
                    // if the uris do not match and tehre is no param
                    if ($uriSegments[$i] !== $routeSegments[$i] && !preg_match('/\{(.+?)\}/', $routeSegments[$i])) {
                        $match = false;
                        break;
                    }

                    // if the uri segments match and there is a param
                    if (preg_match('/\{(.+?)\}/', $routeSegments[$i], $matches)) {
                        $params[$matches[1]] = $uriSegments[$i];
                    }
                }
                if ($match) {
                    $controller = 'App\\Controllers\\' . $route['controller'];
                    $controllerMethod = $route['controllerMethod'];
                    $controllerInstance = new $controller();
                    $controllerInstance->$controllerMethod($params);
                    return;
                }
            }
        }

        ErrorController::notFound();
    }
}
