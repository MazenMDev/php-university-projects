<?php
  declare(strict_types=1);
  const ALLOWED_METHOD = ["GET","POST"];
  const INDEX_URI = '';
  const INDEX_ROUTE = 'index';
  function normalizeURI (string $uri): string {
    $uri = parse_url($uri, PHP_URL_PATH) ?? ''; 
    $uri = strtolower(trim($uri, "/"));
    return $uri === INDEX_URI ? INDEX_ROUTE : $uri; 
  }

  function notFound(): void {
    http_response_code(404);
    echo "404 Not Found";
    exit;
  }

  function badRequest(string $message = 'Bad Request'): void {
    http_response_code(400);
    echo "400 Bad Request: $message";
    exit;
  }

  function serverError(string $message = 'Internal Server Error'): void {
    http_response_code(500);
    echo "500 Internal Server Error: $message";
    exit;
  }

  function getFilePath (string $uri, string $method): string {
    return ROUTES_DIR . "/" . normalizeURI($uri) ."_". strtolower($method) . ".php";
  }

  function redirect(string $uri): void {
    header("Location: /" . normalizeURI($uri));
    exit;
  }
  function dispatch (string $uri, string $method): void {
    $uri = normalizeURI($uri);
    $method = strtoupper($method);
    if (!in_array($method, ALLOWED_METHOD)){
      notFound();
    }

    $filePath = getFilePath($uri, $method);
    if (file_exists($filePath)){
      include ($filePath); 
      return;
    }
    notFound();
  }

?>