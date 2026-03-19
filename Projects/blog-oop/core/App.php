<?php
  namespace Core;

  use Exception;
  use RuntimeException;

  class App {
    protected static $container = [];

    public static function bind(string $key, mixed $value): void {
      App::$container[$key] = $value; 
    }

    public static function get(string $key): mixed {
      if(!array_key_exists($key, App::$container)){
        throw new Exception("No key found for $key");
      }
      return App::$container[$key];
    }
  }

?>