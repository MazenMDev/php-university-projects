<?php

function getDBConnection(): PDO {
  $host = '127.0.0.1';
  $port = '3306';
  $dbname = 'guestbook_db';
  $username = 'root';
  $password = '';

  $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";

  return new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
  ]);
}

function loadSchema(PDO $pdo, string $schemaFile): void {
  if (!file_exists($schemaFile)) {
    throw new RuntimeException("Schema file not found: {$schemaFile}");
  }

  $sql = file_get_contents($schemaFile);
  $pdo->exec($sql);
  echo "Database schema loaded successfully.\n";
}

function insertMessage(PDO $pdo, string $name, string $email, string $message): bool {
  $sql = "INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    ':name' => $name,
    ':email' => $email,
    ':message' => $message,
  ]);
  return $stmt->rowCount() > 0; 
}