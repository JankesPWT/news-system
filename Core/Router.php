<?php
declare(strict_types=1);

namespace App\Core;

class Router
{
    private array $handlers;
    private $notFoundHandler;
    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET';

    public function get(string $path, $handler): void
    {
        $this->addHandler(self::METHOD_GET, $path, $handler);
    }

    public function post(string $path, $handler): void
    {
        $this->addHandler(self::METHOD_POST, $path, $handler);
    }

    public function addNotFoundHandler($handler): void
    {
        $this->notFoundHandler = $handler;
    }

    private function addHandler(string $method, string $path, $handler): void
    {
        $regexPath = preg_replace('/{(\w+)}/', '(?P<$1>[^/]+)', $path);
        $this->handlers[$method . $path] = [
            'path' => $path,
            'regexPath' => '#^' . $regexPath . '$#',
            'method' => $method,
            'handler' => $handler,
        ];
    }

    public function run()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $method = $_SERVER['REQUEST_METHOD'];

        $callback = null;

        foreach($this->handlers as $handler) {
            if(preg_match($handler['regexPath'], $requestPath, $matches) && $method === $handler['method']) {
                $callback = $handler['handler'];
                array_shift($matches);
                break;
            }
        }
        
        if(is_string($callback)) {
            $parts = explode('::', $callback);
            if(is_array($parts)) {
                $className = array_shift($parts);
                $handler = new $className;

                $method = array_shift($parts);
                $callback = [$handler, $method];
            }
        }

        if(!$callback) {
            header(header: "HTTP/1.0 404 Not Found");
            if(!empty($this->notFoundHandler)) {
                $callback = $this->notFoundHandler;
            }
        }
        
        call_user_func_array($callback, [
            array_merge($_GET, $_POST),
            $matches
        ]);
    }
}