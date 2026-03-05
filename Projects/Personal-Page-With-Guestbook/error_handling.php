<?php
  function exceptionHandler(Throwable $exception): void {
    $message = "Unhandled exception: " . $exception->getMessage() . " in " . $exception->getFile() . " on line " . $exception->getLine();
    error_log($message);

    serverError("An unexpected error occurred. Please try again later.");
  }

  function errorHandler(int $errno, string $errstr, string $errfile, int $errline): bool {
    $message = "Error [{$errno}]: {$errstr} in {$errfile} on line {$errline}";
    error_log($message);

    serverError("An unexpected error occurred. Please try again later.");
    return true; 
  }
?>
