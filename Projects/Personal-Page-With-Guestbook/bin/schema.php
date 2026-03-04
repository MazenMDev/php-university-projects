<?php
  declare(strict_types= 1);
  require_once __DIR__ . "/../bootstrap.php";

  loadSchema(
    getDBConnection(),
    DB_DIR . "/schema.sql"
  );

?>