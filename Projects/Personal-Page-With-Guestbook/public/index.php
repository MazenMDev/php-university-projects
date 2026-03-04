<?php 
  declare(strict_types=1);

  if (PHP_SAPI === 'cli-server') {
    $requestedPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $file = __DIR__ . $requestedPath;
    if (is_file($file)) {
      return false;
    }
  }

  require_once __DIR__ . '/../bootstrap.php';

  session_start();

  // handle request 
  dispatch($_SERVER["REQUEST_URI"], $_SERVER["REQUEST_METHOD"]);


?>