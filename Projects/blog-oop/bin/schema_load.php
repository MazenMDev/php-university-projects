<?php
  use Core\App;
  require_once __DIR__ . "/../bootstrap.php";

  $database = App::get("database");

  $schemaFile = __DIR__ . "/../database/schema.sql";
  if (!file_exists($schemaFile)) {
    die("Schema file not found: " . $schemaFile);
  }
  else {
    $sql = file_get_contents($schemaFile);
    try {
      $parts = array_filter(explode(";", $sql));
      foreach ($parts as $statement) {
        $statement = trim($statement);  

        if ($statement === "") {
          continue;
        }

        $database->query($statement);
      }

      echo "Database schema loaded successfully.";
    }
    catch (Exception $e) {
      die("Failed to load database schema: " . $e->getMessage());
    }
  }
?>