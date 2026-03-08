<?php
declare(strict_types=1);

const CSRF_TOKEN_LENGTH = 32;
const CSRF_TOKEN_LIFETIME = 30 * 60; // 30 minutes

function generateCSRFToken(): string {
  $token = bin2hex(random_bytes(CSRF_TOKEN_LENGTH));
  setCSRFTokenAndTime($token);
  return $token;
}

function setCSRFTokenAndTime(?string $token): void {
  if($token === null){
    unset(
      $_SESSION['csrf_token'],
      $_SESSION['csrf_token_time']
    ); 
    return;
  }
  $_SESSION['csrf_token'] = $token;
  $_SESSION['csrf_token_time'] = time();
}

function getCSRFTokenAndTime(): array {
  return [
    $_SESSION['csrf_token'] ?? null,
    $_SESSION['csrf_token_time'] ?? null
  ];
}

function isTokenExpired(?int $time): bool {
  return $time === null || (time() - $time) > CSRF_TOKEN_LIFETIME;
}

function getCurrentCSRFToken(): string {
  [$token, $time] = getCSRFTokenAndTime();
  if (!isset($token, $time) || isTokenExpired($time)) {
    return generateCSRFToken();
  }

  return $_SESSION['csrf_token'];
}

function validateCSRFToken(?string $token): bool {
  [$storedToken, $time] = getCSRFTokenAndTime();
  if(!isset($storedToken, $time)) {
    return false;
  }
  if(isTokenExpired($time)) {
    setCSRFTokenAndTime(null);
    return false;
  }
  $valid = hash_equals($storedToken, $token ?? '');
  if($valid)
    generateCSRFToken();
  
  return $valid;
}