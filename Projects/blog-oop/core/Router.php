<?php 
  namespace Core;

  class Router {
    protected array $routes = []; 

    public function add(string $method, string $uri, string $controller): void {
      $this->routes[] = [
        'method' => $method,
        'uri' => $uri,
        'controller' => $controller,
      ];
    }

    public function dispatch(string $uri, string $method): string {
      $route = $this->findRoute($uri, $method);
      if(!$route) {
        $this->notFound();
      }

      [$controller, $action] = explode('@', $route['controller']); 
      return $this->callAction($controller, $action, $route['params']); 
    } 
    
    protected function findRoute(string $uri, string $method): ?array{
      foreach ($this->routes as $route) {
        $params = $this->matchRoute($route['uri'], $uri);
        if ($params !== null && $route['method'] === $method) {
          return [...$route, 'params' => $params];
        }
      }
      return null;
    }

    protected function matchRoute(string $routeURI, string $requestURI): ?array {
      $routesSegments = explode("/", trim($routeURI, "/"));
      $requestSegments = explode("/", trim($requestURI, "/"));

      if(count($routesSegments) !== count($requestSegments)) {
        return null;
      }

      $params = [];
  
      foreach($routesSegments as $index => $segment){
        if (str_starts_with($segment, "{") && str_ends_with($segment, "}")){
          $params[trim($segment, "{}")] = $requestSegments[$index]; 
        }
        else if ($segment !== $requestSegments[$index]){
          return null;
        }
      }

      return $params;
    }

    protected function callAction(string $controller, string $action, array $params): string {
      $controllerClass = "App\\Controller\\$controller";
      return (new $controllerClass)->$action(...$params);
    }

    public function notFound(): void {
      http_response_code(404);
      echo "404 Not Found";
      exit;
    }
  }

?>