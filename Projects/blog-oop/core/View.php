<?php

  namespace Core;

  use RuntimeException;

  class View {
    public static function render(string $template, array $data = array(), string $layout = null): string {
      $content = View::renderTemplate($template, $data);
      return View::renderLayout($layout, $data, $content);
    }

    protected static function renderTemplate(string $template, array $data): string {
      extract($data); 

      $path = dirname(__DIR__) . "/app/Views/$template.php"; 
      if (!file_exists($path)) {
        echo"". $path ."";
        throw new RuntimeException("Error: View template '$template' not found.");
      } 

      ob_start();
      require $path;
      return ob_get_clean();
    }

    protected static function renderLayout(?string $template, array $data, string $content): string {
      if ($template === null) {
        return $content; 
      }

      extract([...$data, 'content' => $content]); 

      $path = dirname(__DIR__) . "/app/Views/layouts/$template.php";
      if (!file_exists($path)) {
        throw new RuntimeException("Error: Layout template '$template' not found.");
      } 

      ob_start();
      require $path;
      return ob_get_clean();
    }
  }


?>