<?php

namespace Core;

use InvalidArgumentException;
use PDO;
use PDOException;
use PDOStatement;

class Database {
  protected $pdo;

  public function __construct(array $config) {
    try {
      $dsn = $this->createDSN($config);
      $this->pdo = new PDO(
        $dsn,
        $config['user'] ?? null,
        $config['password'] ?? null,
        $config['options'] ?? []
      );
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
      die("Database connection failed: " . $e->getMessage());
    }
  }

  protected function createDSN(array $config): string{
    $driver = $config["driver"];
    $database = $config["database"];

    return match ($driver) {
      'mysql' => "mysql:host={$config['host']};port={$config['port']};dbname={$database};charset=utf8mb4",
      default => throw new InvalidArgumentException("Unsupported database driver: {$driver}")
    };
  }

  public function query(string $sql, array $params = []): PDOStatement {
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt;
  }

  public function fetchAll(string $sql, array $params = []): array {
    return $this->query($sql, $params)->fetchAll(PDO::FETCH_OBJ); 
  }

  public function fetch(string $sql, array $params = []): object|false {
    return $this->query($sql, $params)->fetch(PDO::FETCH_OBJ);
  }

  public function lastInsertId(): string|false {
    return $this->pdo->lastInsertId(); 
  }
}